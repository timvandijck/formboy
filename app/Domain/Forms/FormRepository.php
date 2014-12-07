<?php

namespace Formboy\Domain\Forms;

use Formboy\Exceptions\InvalidTemplateException;
use Formboy\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FormRepository {

    /**
     * @param string $formName
     * @param UploadedFile $templateFile
     * @param User $user
     *
     * @throws InvalidTemplateException
     *
     * @return Form $form
     */
    public function saveForm($formName, UploadedFile $templateFile, User $user) {
        $templateFileContents = file_get_contents($templateFile->getRealPath());

        if (strpos($templateFileContents,'{{FormSubmit}}') !== false) { // Check if the form-submit token is in the file.
            $form = new Form();
            $form->name = $formName;
            $form->user_id = $user->id;
            $form->template = $templateFile->getClientOriginalName();
            $form->save();

            $templateFile->move(public_path() . '/uploads');

            return $form;

        } else {
            throw new InvalidTemplateException('There is no {{FormSubmit}} token in the template.');
        }
    }

    public function getForm($id) {
        return Form::findOrFail($id);
    }
} 