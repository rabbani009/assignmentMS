<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    
    public function submittedAssignments()
    {
        return $this->hasMany(SubmittedAssignment::class, 'assignment_id', 'id');
    }
   

}
