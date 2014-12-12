<?php

namespace Formboy\Forms\FormSubmissions;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model {
    function data() {
        return $this->hasMany('Formboy\Forms\FormSubmissions\SubmissionData\SubmissionData', 'submission_id');
    }
}