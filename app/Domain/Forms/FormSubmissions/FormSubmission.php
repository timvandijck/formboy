<?php

namespace Formboy\Forms\FormSubmissions;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model {
    function submissionData() {
        $this->hasMany('SubmissionData', 'submission_id');
    }
}