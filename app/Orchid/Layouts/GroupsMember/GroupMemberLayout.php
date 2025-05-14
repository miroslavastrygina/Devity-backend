<?php

namespace App\Orchid\Layouts\Groups;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class GroupMemberLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Relation::make('users')
                ->fromModel(User::class, 'email')
                ->applyScope('permission')
                ->multiple()
                ->title('Выбери ученика')
        ];
    }
}
