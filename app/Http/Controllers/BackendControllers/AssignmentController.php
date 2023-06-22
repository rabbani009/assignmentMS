<?php

namespace App\Http\Controllers\BackendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AssignmentStoreRequest;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commons['page_title'] = 'Assignment Section';
        $commons['content_title'] = 'Assignment List';
        $commons['main_menu'] = 'assignment';
        $commons['current_menu'] = 'assignment_index';

        $assignments = Assignment::where('status', 1)->with(['createdBy', 'updatedBy'])->paginate(3);

        $classes = Assignment::where('status', 1)
        ->pluck('class', 'id')
        ->unique();

        $subjects = Assignment::where('status', 1)
        ->pluck('subject', 'id')
        ->unique();

        return view('backend.pages.assignment.index',
        compact(
            'commons',
            'assignments',
            'classes',
            'subjects'
        )
    );


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commons['page_title'] = 'Assignment Section';
        $commons['content_title'] = 'Add new Assignment';
        $commons['main_menu'] = 'assignment';
        $commons['current_menu'] = 'assignment_create';


        return view('backend.pages.assignment.create',
        compact(
            'commons',

        )
    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentStoreRequest $request)
    {
        //    dd($request->all());
        $assignmets = new Assignment();
        $assignmets->class = $request->validated('class');
        $assignmets->section = $request->validated('section');
        $assignmets->assignment = $request->validated('assignment');
        $assignmets->assign_date = $request->validated('assign_date');
        $assignmets->submission_date = $request->validated('submission_date');
        $assignmets->assignment_id = $request->validated('assignment_id');
        $assignmets->subject = $request->validated('subject');
        $assignmets->assignment_description = $request->validated('assignment_description');
        $assignmets->assignment_status = 1;
        $assignmets->status = 1;
        $assignmets->created_at = Carbon::now();
        $assignmets->created_by = Auth::user()->id;
    
        if ($request->hasFile('attached_file')) {
            $image = $request->file('attached_file');
            $image_name = $image->getClientOriginalName();
            $destinationPath = public_path('/attachments');
            $image->move($destinationPath, $image_name);
            $assignmets->attached_file = 'attachments/' . $image_name;
        }
        
        $assignmets->save();
    
        if ($assignmets->wasRecentlyCreated) {
            return redirect()
                ->route('assignment.index')
                ->with('success', 'Assignment created successfully!');
        }
    
        return redirect()
            ->back()
            ->with('failed', 'Try again !');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function classFilter(Request $request)
    {
        $assignments = Assignment::where('status', 1)
        ->where('class', $request->class)
        ->with(['createdBy', 'updatedBy'])
        ->paginate(3);
    
        $view = view('backend/pages/ajax/_table', compact('assignments'))->render();
    
        return $view;
    }
    


    public function subjectFilter(Request $request){ 
       $assignments = Assignment::where('status', 1)
        ->where('subject', $request->subject)
        ->with(['createdBy', 'updatedBy'])
        ->get();
    
        $view = view('backend/pages/ajax/_table', compact('assignments'))->render();
    
        return $view;
    }



}
