<?php

namespace App\Services;

use App\Http\Requests\GroupMemberRequest;
use App\Models\GroupMember;

class GroupMemberService
{
    public function index()
    {
        return GroupMember::with('group', 'user')->get();
    }

    public function create(GroupMemberRequest $groupMember)
    {
        $groupMemberData = $groupMember->validated();
        $newMember = GroupMember::create($groupMemberData);

        return $newMember;
    }

    public function delete(int $id)
    {
        $deletedGroupMember = GroupMember::find($id);
        $deletedGroupMember->delete();
    }
}
