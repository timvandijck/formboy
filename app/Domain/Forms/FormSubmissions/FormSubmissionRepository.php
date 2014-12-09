<?php

namespace Formboy\Forms\FormSubmissions;

use Formboy\Domain\Forms\Form;
use Formboy\Forms\FormSubmissions\SubmissionData\SubmissionData;

class FormSubmissionRepository {

    /**
     * Saves a form submission.
     *
     * @param $data array
     *      associative array $fieldId => $value
     *
     * @param $form Form
     *
     * @return FormSubmission
     */
    public function saveSubmission($data, Form $form) {
        $submission = new FormSubmission();
        $submission->form_id = $form->id;
        $submission->save();

        foreach ($data as $field_id => $value) {
            $fieldData = new SubmissionData();
            $fieldData->data = $value;
            $fieldData->field_id = $field_id;
            $fieldData->submission_id = $submission->id;
            $fieldData->save();
        }

        return $submission;
    }
} 