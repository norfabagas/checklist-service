<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checklist;
use Auth;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index(Request $request)
    {
        $checklists = Auth::user()->checklists()->get();

        return response()->json([
            'status' => 'success',
            'result' => $checklists
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191'
        ]);

        if (Auth::user()->checklists()->Create($request->all())) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }

    public function show($id)
    {
        $checklist = Checklist::where('id', $id)->get();

        return response()->json($checklist);
    }

    public function edit($id)
    {
        $checklist = Checklist::where('id', $id)->get();

        return view('checklist.edit', ['checklist' => $checklist]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'filled'
        ]);

        $checklist = Checklist::find($id);

        if ($checklist->fill($request->all()->save())) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }

    public function destroy($id)
    {
        if (Checklist::destroy($id)) {
            return response()->json(['status' => 'success']);
        }
    }
}