<?php

namespace App\Orchid\Screens\Groups;

use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use App\Services\GroupService;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Groups\GroupListTable;

class GroupListScreen extends Screen
{
    public function __construct(
        private readonly GroupService $groupService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $groups = $this->groupService->index();

        return [
            'groups' => $groups
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Группы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать группу')
                ->route('platform.groups.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            GroupListTable::class
        ];
    }
}
