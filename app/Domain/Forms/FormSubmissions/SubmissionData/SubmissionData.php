<?php

namespace Formboy\Forms\FormSubmissions\SubmissionData;

use Illuminate\Database\Eloquent\Model;

class SubmissionData extends Model{
    function submission() {
        $this->belongsTo('FormSubmission', 'submission_id');
    }

    function field() {
        $this->belongsTo('Field', 'field_id');
    }
}