<?php

namespace App\Orchid\Screens\Blocks;

use App\Orchid\Layouts\Blocks\BlockListTable;
use App\Services\BlockService;
use Orchid\Screen\Screen;

class BlockListScreen extends Screen
{
    public function __construct(
        private readonly BlockService $blockService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $blocks = $this->blockService->index();

        return [
            'blocks' => $blocks
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Блоки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            BlockListTable::class
        ];
    }
}