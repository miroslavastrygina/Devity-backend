<?php

namespace App\Models;

use App\Models\GroupMember;
use App\Models\Achievement;
use Orchid\Screen\AsSource;
use App\Models\TestUserResult;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    use AsSource, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Normalize permissions: seeders sometimes pass JSON strings, which the array
     * cast double-encodes and later surfaces as a string in Orchid's admin UI.
     */
    protected function permissions(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value): ?array {
                if ($value === null) {
                    return null;
                }

                while (is_string($value)) {
                    $decoded = json_decode($value, true);

                    if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                        return [];
                    }

                    $value = $decoded;
                }

                return is_array($value) ? $value : [];
            },
            set: function (mixed $value): ?string {
                if ($value === null) {
                    return null;
                }

                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    $value = is_array($decoded) ? $decoded : [];
                }

                return json_encode($value);
            },
        );
    }

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'         => Where::class,
        'name'       => Like::class,
        'email'      => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePermission(Builder $query)
    {
        return $query->whereNull('permissions');  // лучше использовать whereNull
    }

    public function testUserResults()
    {
        return $this->hasMany(TestUserResult::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members');
    }

    public function groupsTeach()
    {
        return $this->hasMany(Group::class, 'teacher_id');
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
            ->withPivot('awarded_at')
            ->withTimestamps();
    }
}
