<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Services\MemberService;
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
        $memberService = new MemberService;
        $name = $request->name ?? '';

        if ($name === '') {
            return redirect('members')
            ->with('status', 'Tambah anggota gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable',
            'date' => 'nullable',
        ]);

        $author = new Member();
        $author->name = $validatedData['name'];
        $author->email = $validatedData['email'];
        $author->registration_date = $validatedData['date'];

        if($memberService->createMember($author)) {
            return redirect('members')->with('status', 'Anggota berhasil ditambahkan!')
            ->with('clearStatus', true);
        }

        return redirect('members')->with('status', 'Tambah anggota gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function detail($id)
    {
        $member = Member::findOrFail($id);
        return view('member-edit', [
            'member' => $member,
        ]);
    }

    public function update(Request $request)
    {
        $memberService = new MemberService;
        $memberId = $request->member_id  ?? '';
        $name = $request->name ?? '';

        if ($name === '') {
            return redirect('members')
            ->with('status', 'Edit anggota gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable',
            'date' => 'nullable',
        ]);

        $member = Member::findOrFail($memberId);
        $member->name = $validatedData['name'];
        $member->email = $validatedData['email'];
        $member->registration_date = $validatedData['date'];

        if($memberService->updateMember($member)) {
            return redirect('members')->with('status', 'Anggota berhasil dieditkan!')
            ->with('clearStatus', true);
        }

        return redirect('members')->with('status', 'Edit anggota gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function destroy(Request $request)
    {
        $memberService = new MemberService;

        $memberId = $request->member_id ?? '';

        if($memberService->deleteMember($memberId)) {
            return redirect('members')->with('status', 'Anggota berhasil dihapus!')
            ->with('clearStatus', true);
        }

        return redirect('members')->with('status', 'Hapus anggota Gagal, Silahkan coba lagi!')
        ->with('clearStatus', true);
    }
}
