<?php

namespace App\Orchid\Screens\Blocks;

use Orchid\Screen\Screen;
use App\Services\BlockService;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Blocks\BlockListTable;

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
        return [
            Link::make('Создать блок')
                ->route('platform.blocks.create')
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
            BlockListTable::class
        ];
    }

    public function delete($id)
    {
        $this->blockService->delete($id);
        Toast::info("Блок успешно удален");

        return redirect()->route('platform.blocks');
    }
}
