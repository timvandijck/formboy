<?php

namespace Formboy\Domain\Forms;

use Formboy\Exceptions\InvalidTemplateException;
use Formboy\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FormRepository {

    protected $formParser;

    function __construct(FormParser $formParser)
    {
        $this->formParser = $formParser;
    }

    /**
     * @param string $formName
     * @param UploadedFile $templateFile
     * @param User $user
     *
     * @throws InvalidTemplateException
     *
     * @return Form $form
     */
    public function saveForm($formName, UploadedFile $templateFile, UploadedFile $completePage, UploadedFile $cssFile, UploadedFile $jsFile, User $user) {
        $templateFileContents = file_get_contents($templateFile->getRealPath());

        if (strpos($templateFileContents,'{{FormSubmit}}') !== false) { // Check if the form-submit token is in the file.
            $form = new Form();
            $form->name = $formName;
            $form->user_id = $user->id;
            $form->template = $templateFile->getClientOriginalName();
            $form->complete_page = $completePage->getClientOriginalName();
            $form->css_file = $cssFile->getClientOriginalName();
            $form->javascript_file = $cssFile->getClientOriginalName();
            $form->save();

            $this->formParser->processForm($templateFileContents, $form);

            $directory = $this->formParser->getFilePath($form);

            $templateFile->move($directory, $templateFile->getClientOriginalName());
            $completePage->move($directory, $completePage->getClientOriginalName());
            $cssFile->move($directory, $cssFile->getClientOriginalName());
            $jsFile->move($directory, $jsFile);

            return $form;

        } else {
            throw new InvalidTemplateException('There is no {{FormSubmit}} token in the template.');
        }
    }

    /**
     * @param integer $id
     * @param boolean $lazyLoadChildren
     *
     * @return Form
     */
    public function getForm($id, $lazyLoadChildren = false) {
        $query = Form::where('id','=',$id);

        if($lazyLoadChildren == true) {
            $query->with('fields');
        }

        return $query->firstOrFail();
    }

    /**
     * Retrieve all forms that belong to a user.
     *
     * @param int $userId
     * @return array
     */
    public function getFormsByUser($userId) {
        return Form::where('user_id', '=', $userId)->orderBy('created_at', 'DESC')->get();
    }
} 