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
        $group = Group::find($id);

        return $group;
    }

    public function create(GroupRequest $group)
    {
        $groupData = $group->validated();
        $newGroup = Group::create($groupData);

        return $newGroup;
    }

    public function update(int $id, GroupRequest $group)
    {
        $groupData = $group->validated();
        $updateGroup = $this->show($id);
        $updateGroup->update($groupData);
        $updateGroup->save();

        return $updateGroup;
    }

    public function delete(int $id)
    {
        $deletedGroup = $this->show($id);
        $deletedGroup->delete();
    }
}