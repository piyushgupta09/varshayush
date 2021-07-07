<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.checklists.index', [
            'taskers' => User::all(),
            'checklists' => Checklist::all(),
            'total_tasks' => Task::all()->count(),
            'pending_tasks' => Task::pending()->get()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.checklist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklist = new Checklist();
        $checklist->user_id =  $request->tasker;
        $checklist->title =  $request->title;
        $checklist->detail =  $request->detail;
        $checklist->budget =  ($request->budget) ?? '0';
        $checklist->urgent =  $request->has('urgent');
        $checklist->account =  $request->has('account');
        $checklist->color =  $request->color;
        $checklist->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        return view('app.checklist.show', compact('checklist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        return view('app.checklist.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        $checklist->user_id =  $request->tasker;
        $checklist->title =  $request->title;
        $checklist->detail =  $request->detail;
        $checklist->budget =  ($request->budget) ?? '0';
        $checklist->urgent =  $request->has('urgent');
        $checklist->account =  $request->has('account');
        $checklist->color =  $request->color;;
        $checklist->update();
        return back();
    }

    public function persist(Request $request)
    {
        $checklist = Checklist::where('id', $request->checklist)->first();
        $checklist->user_id =  $request->tasker;
        $checklist->title =  $request->title;
        $checklist->detail =  $request->detail;
        $checklist->budget =  $request->budget;
        $checklist->urgent =  $request->has('urgent');
        $checklist->account =  $request->has('account');
        $checklist->color =  $request->color;;
        $checklist->save();
        return back();
    }

    public function archive(Request $request)
    {
        $checklist = Checklist::where('id', $request->checklist)->first();
        $checklist->archived =  !$checklist->archived;
        $checklist->save();
        return back();
    }

    public function delete(Request $request)
    {
        $checklist = Checklist::where('id', $request->checklist)->first();
        $checklist->delete();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return back();
    }
}
