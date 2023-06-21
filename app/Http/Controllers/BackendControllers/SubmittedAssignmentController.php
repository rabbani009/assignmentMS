<?php

namespace App\Http\Controllers\BackendControllers;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\SubmittedAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubmittedAssignmentController extends Controller
{
    public function submitAssignment(Request $request)
    {
        // dd($request->all());

            $assignmentId = $request->input('assignment_id');
            $studentId = $request->input('student_id');
            $attachedFile = $request->file('attached_file');

        //If student submit assignment once then.
            $existingSubmission = SubmittedAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', $studentId)
            ->first();

            //if submitted once
            if ($existingSubmission) {
                return redirect()->back()->with('warning', 'Assignment already submitted.');
            }

            //Overdue
            $assignment = Assignment::where('assignment_id', $assignmentId)->first();
            // dd($assignment);
            if ($assignment->submission_date < date('Y-m-d')) {
                return redirect()->back()->with('warning', 'Assignment submission date has passed.');
            }
        
            $submittedAssignment = new SubmittedAssignment();
            $submittedAssignment->assignment_id = $assignmentId;
            $submittedAssignment->student_id = $studentId;
            $submittedAssignment->submitted_time = date('Y-m-d');
            
            //This is for uploaded file by student
            if ($request->hasFile('attached_file')) {
                $image = $request->file('attached_file');
                $image_name = $image->getClientOriginalName();
                $destinationPath = public_path('/submittedassignments');
                $image->move($destinationPath, $image_name);
                $submittedAssignment->attached_file = 'submittedassignments/' . $image_name;
            }
            $submittedAssignment->save();
            return redirect()->back()->with('success', 'Assignment submitted successfully.');
        }
}
