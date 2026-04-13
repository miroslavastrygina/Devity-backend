<?php

namespace App\Orchid\Layouts\Blocks;

use App\Models\Block;
use Orchid\Screen\TD;
use App\Models\Course;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class BlockListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'blocks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('title', 'Название')->render(function ($item) {
                return Link::make($item->title)->route('platform.blocks.edit', $item->id);
            })->sort(),
            TD::make('description', 'Описание')->sort(),
            TD::make('course', 'Курс')->render(function ($item) {
                return Link::make($item->course->title)->route('platform.courses');
            })->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
            TD::make(("Действия"))
                ->align(TD::ALIGN_CENTER)
                ->render(
                    fn(Block $item) => DropDown::make()
                        ->icon("bi.list-ul")
                        ->list([
                            Link::make('Изменить')
                                ->icon("bi.pen")
                                ->route("platform.blocks.edit", $item),
                            Button::make("Удалить")
                                ->icon('bs.trash3')
                                ->confirm("Вы уверены, что хотите удалить этот блок ?")
                                ->method('deleteBlock', ["id" => $item->id]),
                        ])
                ),
        ];
    }
}
