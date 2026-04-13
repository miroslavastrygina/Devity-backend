<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Screen\AsSource;

class Course extends Model
{
    use AsSource;
    use Sortable;

    protected $fillable = [
        'title',
        'description',
    ];

    public function block()
    {
        return $this->hasMany(Block::class);
    }

    protected $allowedSorts = [
        'id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];
}