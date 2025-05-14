<?php

namespace App\Orchid\Screens\Groups;

use App\Models\User;
use App\Models\Group;
use Orchid\Screen\Screen;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Services\GroupService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use App\Http\Requests\GroupRequest;
use App\Services\GroupMemberService;
use Orchid\Screen\Actions\ModalToggle;
use App\Http\Requests\GroupMemberRequest;
use App\Orchid\Layouts\Groups\GroupEditLayout;
use App\Orchid\Layouts\Groups\GroupMemberLayout;
use App\Orchid\Layouts\GroupsMember\GroupMemberListTable;

class GroupEditScreen extends Screen
{
    public $group;

    public function __construct(
        private readonly GroupService $groupService,
        private readonly GroupMemberService $groupMemberService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->group = $this->groupService->show($id);
        } else {
            $this->group = new Group();
        }

        return [
            'group' => $this->group,
            'members' => $this->group->members
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->group->id ? 'Подробнее о "' . $this->group->name . '"' : 'Создать группу';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('save'),
            Button::make('Удалить')
                ->method('delete'),
            ModalToggle::make('Добавить пользователя в группу')
                ->modal('attachModal')
                ->method('attach')
                ->icon('full-screen'),
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
            GroupEditLayout::class,
            GroupMemberListTable::class,
            Layout::modal('attachModal', [
                Layout::rows([
                    Relation::make('user_id')
                        ->fromModel(User::class, 'email')
                        ->applyScope('permission')
                        ->title('Выбери ученика')
                        ->required(),
                    Input::make('group_id')->value($this->group->id)->hidden()
                ]),
            ])->title('Добавление пользователя в группу'),
        ];
    }

    public function save(GroupRequest $request)
    {
        if (isset($this->group->id)) {
            $this->groupService->update($this->group->id, $request);
            Toast::info("Группа успешно обновлен");
        } else {
            $newGroup = $this->groupService->create($request);
            Toast::info("Группа успешно создана");

            return redirect()->route('platform.groups.edit', $newGroup->id);
        }
    }

    public function delete()
    {
        if (isset($this->group->id)) {
            $this->groupService->delete($this->group->id);
            Toast::info("Урок успешно удален");

            return redirect()->route('platform.groups');
        }
    }

    public function attach(GroupMemberRequest $req)
    {
        $data = $req->validated();
        $exists = GroupMember::where('group_id', $data['group_id'])
            ->where('user_id', $data['user_id'])
            ->exists();

        if ($exists) {
            Toast::warning("Этот пользователь уже в группе");
            return back();
        }

        $this->groupMemberService->create($req);
        Toast::info("Пользователь добавлен в группу");
    }

    public function detach(int $id)
    {
        if (isset($id)) {
            $this->groupMemberService->delete($id);
            Toast::info("Пользователь успешно откреплен");

            return redirect()->route('platform.groups.edit', $this->group->id);
        }
    }
}
