<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Checklist;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title =  $request->title;
        $task->detail =  $request->detail;
        $task->priority =  $request->priority;
        $task->checklist_id = $request->checklist;
        $task->rate =  ($request->rate > 0) ?? '0';
        $task->unit =  ($request->unit > 0) ?? '0';
        $task->amount =  ($request->amount > 0) ?? '0';
        $task->completed =  $request->completed == 'on';
        $task->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function persist(Request $request)
    {dd($request);
        $task = Task::where('id', $request->task)->first();
        if ($request->source == 'checkbox') {
            $task->completed =  !$task->completed;
        } else {
            $task->title =  $request->title;
            $task->detail =  $request->detail;
            $task->priority =  $request->priority;
            $task->rate =  ($request->rate > 0) ?? '0';
            $task->unit =  ($request->unit > 0) ?? '0';
            $task->amount =  ($request->amount > 0) ?? '0';
            $task->checklist_id = Checklist::where('slug', $request->checklist)->first()->id;
        }
        $task->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
