<?php

namespace Formboy\Domain\Forms;

use Formboy\Domain\Forms\Fields\Field;
use Masterminds\HTML5;

class FormParser {

    /**
     * Extracts the fields from the form.
     *
     * @param string $formContent
     * @param Form $form
     */
    public function processForm($formContent, Form $form) {
        $html5 = new HTML5();
        $dom = $html5->loadHTML($formContent);

        $inputs = $dom->getElementsByTagName('input');

        foreach ($inputs as $input) {
            if($input->getAttribute('data-fillable') === 'true' && $input->getAttribute('name') != '') {
                $field = new Field();
                $field->form_id = $form->id;
                $field->name = $input->getAttribute('name');

                if(strpos($input->getAttribute('class'),'required') !== false) {
                    $field->required = true;
                }

                $field->save();
            }
        }
    }

    /**
     * Generate the HTML for a form.
     *
     * @param $form
     * @return mixed|string
     */
    public function renderForm($form, $errors = array()) {
        $output = file_get_contents($this->getFilePath($form) . $form->template);

        $output = str_replace('{{FormSubmit}}', '/form/submit', $output);

        $errorList = '';
        if (count($errors) > 0) {
            $errorList .= '<ul>';
            foreach($errors as $error) {
                $errorList .= "<li>$error</li>";
            }
            $errorList .= '</ul>';
        }

        $output = str_replace('{{FormErrors}}', $errorList, $output);

        $magic = '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        $magic .= '<input type="hidden" name="form_id" value="' . $form->id . '">';

        $output = str_replace('{{Magic}}', $magic, $output);

        $output = $this->addScripts($output, $form);
        $output = $this->addCss($output, $form);

        return $output;
    }

    public function renderCompletePage($form) {
        $output = file_get_contents($this->getFilePath($form) . $form->complete_page);

        $output = $this->addScripts($output, $form);
        $output = $this->addCss($output, $form);

        return $output;
    }

    /**
     * Checks if a form contains all required tokens.
     *
     * @todo implement this.
     */
    public function validateForm() {
        // @todo Check for the Magic Token

        // @todo Check for FormSubmit Token
    }

    /**
     * @param $form
     * @return string
     */
    public function getFilePath($form, $full = true)
    {
        if($full) {
            return public_path() . '/uploads/' . $form->user_id . '/' . $form->id . '/';
        } else {
            return '/uploads/' . $form->user_id . '/' . $form->id . '/';
        }
    }

    /**
     * @param $output
     * @return string
     */
    protected function addScripts($output, $form)
    {
        $scripts = '<script src="/js/vendor/jquery.js"></script>';
        $scripts .= '<script src="/js/validation.js"></script>';

        if(isset($form->javascript_file) && $form->javascript_file != '') {
            $file = $this->getFilePath($form, false) . $form->javascript_file;
            $scripts .= '<script src="' . $file . '"></script>';
        }

        $output = str_replace('{{Scripts}}', $scripts, $output);

        return $output;
    }

    /**
     * @param $output
     * @return string
     */
    protected function addCss($output, $form)
    {
        $file = $this->getFilePath($form, false) . $form->css_file;

        $css = '<link href="' . $file . '" rel="stylesheet">';

        $output = str_replace('{{CSS}}', $css, $output);

        return $output;
    }
}