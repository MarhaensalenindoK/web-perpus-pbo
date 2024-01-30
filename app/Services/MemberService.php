<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function getMembers()
    {
        return Member::all();
    }

    public function getMemberById($id)
    {
        return Member::findOrFail($id);
    }

    public function createMember(Member $member)
    {
        return $member->save();
    }

    public function updateMember($id, Member $member)
    {
        return Member::where('id', $id)->update($member->toArray());
    }

    public function deleteMember($id)
    {
        return Member::destroy($id);
    }
}