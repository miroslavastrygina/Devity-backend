<?php

namespace App\Orchid\Screens\Blocks;

use App\Models\Block;
use App\Orchid\Layouts\Blocks\BlockEditLayout;
use App\Orchid\Layouts\Lessons\LessonListTable;
use App\Services\BlockService;
use App\Services\CourseService;
use Orchid\Screen\Screen;

class BlockScreen extends Screen
{
    public $block;

    public function __construct(
        private readonly BlockService $blockService,
        private readonly CourseService $courseService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->block = $this->blockService->show($id);
        } else {
            $this->block = new Block();
        }

        $courses = $this->courseService->index();
        return [
            'block' => $this->block,
            'lessons' => $this->block->lessons,
            'courses' => $courses
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->block->id ? 'Подробнее о "' . $this->block->title . '"' : 'Создать блок';
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
            BlockEditLayout::class,
            LessonListTable::class
        ];
    }
}