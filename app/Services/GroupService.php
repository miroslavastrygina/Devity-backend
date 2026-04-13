<?php

namespace App\Services;

use App\Http\Requests\GroupRequest;
use App\Models\Group;

class GroupService
{
    public function index()
    {
        return Group::all();
    }

    public function show(int $id)
    {
        $group = Group::with(['members.user'])->find($id);

        return $group;
    }

    public function create(GroupRequest $group)
    {
        $groupData = $group->validated();
        $newGroup = Group::create($groupData['group']);

        return $newGroup;
    }

    public function update(int $id, GroupRequest $group)
    {
        $groupData = $group->validated();
        $updateGroup = $this->show($id);
        $updateGroup->update($groupData['group']);
        $updateGroup->save();

        return $updateGroup;
    }

    public function delete(int $id)
    {
        $deletedGroup = $this->show($id);
        $deletedGroup->delete();
    }
}
