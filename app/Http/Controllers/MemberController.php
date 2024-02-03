<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::paginate(1);
        return view('member.index', [
            'members' => $members
        ]);
    }

    public function store(Request $request)
    {
        return redirect('members')->with('status', 'Tambah Anggota Berhasil');
    }

    public function detail($id)
    {
        $member = Member::findOrFail($id);
        return view('member-edit', [
            'member' => $member,
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect('members')->with('status', 'Update Anggota Berhasil');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect('members')->with('status', 'Hapus Anggota Berhasil');
    }
}
