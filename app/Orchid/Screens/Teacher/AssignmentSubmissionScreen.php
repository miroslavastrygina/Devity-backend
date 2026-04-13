<?php

namespace App\Orchid\Screens\Teacher;

use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\AssignmentGrade;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Legend;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Orchid\Layouts\Teacher\GradeLayout;
use App\Services\AssignmentSubmissionService;

class AssignmentSubmissionScreen extends Screen
{
    public $email;
    public $assignmentSubmission;
    public function __construct(private readonly AssignmentSubmissionService $assignmentSubmissionService) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(?int $id = null): iterable
    {
        $assignmentSubmission = $this->assignmentSubmissionService->show($id);
        $this->email = $assignmentSubmission->user->email;
        $this->assignmentSubmission = $assignmentSubmission;
        return [
            "assignmentSubmission" => $assignmentSubmission
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Решение от ' . $this->email;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Подтвердить проверку')
                ->confirm('Вы готовы отправить результа ученику')
                ->method('save'),
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
            Layout::legend(
                'assignmentSubmission',
                [
                    Sight::make('id'),
                    Sight::make('user_id', 'Ученик')->render(
                        function ($item) {
                            return $item->user->name . " " .
                                $item->user->surname . " " . $item->user->patronymic;
                        }
                    ),
                    Sight::make('Email')->render(
                        function ($item) {
                            return $item->user->email;
                        }
                    ),
                    Sight::make('Группы')->render(
                        function ($item) {
                            $groups = $item->user->groups;
                            $groupMsgs = "";
                            foreach ($groups as $value) {
                                $groupMsgs .= $value->name;
                            }
                            return $groupMsgs;
                        }
                    ),
                    Sight::make('assignment_id', 'Задание')->render(
                        function ($item) {
                            return $item->assignment->title;
                        }
                    ),
                    Sight::make('file_url', 'Файл')->render(function ($item) {
                        // Получаем имя файла из URL
                        $filename = basename($item->file_url);

                        // Собираем относительный путь на диске 'public'
                        $path = "submissions/{$filename}";

                        // Проверка существования файла
                        if (!Storage::disk('public')->exists($path)) {
                            return 'Файл не найден';
                        }

                        // Получаем расширение файла
                        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                        // Список расширений, которые нужно скачивать
                        $downloadable = ['doc', 'docx', 'xls', 'xlsx', 'pdf'];

                        // Если файл из списка для скачивания — показываем ссылку
                        if (in_array($extension, $downloadable)) {
                            $url = asset('storage/' . $path);
                            return "<a href=\"{$url}\" download>Скачать {$filename}</a>";
                        }

                        // Иначе пытаемся отобразить содержимое (для текстовых файлов)
                        $content = Storage::disk('public')->get($path);
                        $escaped = e($content);

                        return "<pre style='max-height: 400px; overflow: auto; background: #f7f7f7; padding: 10px;'>{$escaped}</pre>";
                    })

                ]
            ),
            GradeLayout::class
        ];
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'score' => "required|integer|min:0|max:100",
            'feedback' => 'string|nullable'
        ]);
        $data['submission_id'] = $this->assignmentSubmission->id;
        $data['teacher_id'] = Auth::id();

        AssignmentGrade::create($data);
        $this->assignmentSubmission->rated = true;
        $this->assignmentSubmission->save();

        Toast::info("Задание проверено");
        return redirect()->route('platform.assignment-submissions');
    }
}
