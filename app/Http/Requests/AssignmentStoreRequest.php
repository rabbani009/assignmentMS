<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'class' => 'required|string',
            'section' => 'required|string',
            'assignment' => 'required|string',
            'assign_date' => 'required|date',
            'submission_date' => 'required|date',
            'assignment_id' => 'nullable|string|unique:assignments',
            'subject' => 'nullable|string',
            'assignment_description' => 'nullable|string',
            'attached_file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
