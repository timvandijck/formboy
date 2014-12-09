<?php

namespace Formboy\Http\Requests;

class FormCreateRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'template_file' => 'required|max:1024|mimes:xhtml,shtml,html,htm',
            'complete_page' => 'required|max:1024|mimes:xhtml,shtml,html,htm',
            'javascript_file' => 'max:1024|mimes:js',
            'css_file' => 'max:1024|mimes:css'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
} 