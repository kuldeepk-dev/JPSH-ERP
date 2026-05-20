<?php

namespace App\Http\Controllers\Admin\SystemSettings;

use App\Http\Controllers\Controller;
use App\SmBoard;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SmBoardController extends Controller
{
    public function index()
    {
        $boards = SmBoard::where('school_id', Auth::user()->school_id)
            ->orderBy('name')
            ->get();

        return view('backEnd.systemSettings.boards', compact('boards'));
    }

    public function show($id)
    {
        $board = SmBoard::where('id', $id)
            ->where('school_id', Auth::user()->school_id)
            ->first();

        $boards = SmBoard::where('school_id', Auth::user()->school_id)
            ->orderBy('name')
            ->get();

        return view('backEnd.systemSettings.boards', compact('board', 'boards'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:sm_boards,name,NULL,id,school_id,' . Auth::user()->school_id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $board = new SmBoard();
        $board->name = trim((string) $request->name);
        $board->school_id = Auth::user()->school_id;
        $board->active_status = 1;
        $board->save();

        Toastr::success('Operation successful', 'Success');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $board = SmBoard::where('id', $id)
            ->where('school_id', Auth::user()->school_id)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:sm_boards,name,' . $board->id . ',id,school_id,' . Auth::user()->school_id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $board->name = trim((string) $request->name);
        $board->save();

        Toastr::success('Operation successful', 'Success');

        return redirect()->route('boards');
    }

    public function destroy($id)
    {
        $board = SmBoard::where('id', $id)
            ->where('school_id', Auth::user()->school_id)
            ->first();

        if ($board) {
            $board->delete();
        }

        Toastr::success('Operation successful', 'Success');

        return redirect()->back();
    }
}
