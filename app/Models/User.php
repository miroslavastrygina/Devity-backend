<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Screen\AsSource;
use App\Models\TestUserResult;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Laravel\Sanctum\HasApiTokens;
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
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

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
}
