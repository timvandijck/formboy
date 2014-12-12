## Formboy

Formboy is a web application that allows front-end developers to upload a fully functional and styled webform without having to write a single line of PHP.

The application is being build on the Laravel framework (version 5). For it's requirements check http://laravel.com/docs.

## Installation
TBA

## Usage
1) Build your form in plain HTML, CSS and Javascript.
2) Upload your form.
3) You're done!

### Validation
In order to do some validation on your fields you can add one of the following classes to your input-fields.

Class           | Validation
--------------- | -------------
required        | Check if the field contains a value.
validate-email  | Check if a valid e-mailadres is given.

### Required tokens
In order to make your form functional we need you to include some tokens.

Token                 | What it does
--------------------- | -------------------------------------
{{FormErrors}}        | Outputs validation errors.
{{FormSubmit}}        | Sets the action-attribute of the form. Put as the action="" attribute.
{{Magic}}             | Some magic stuff like CSRF protection. Put between the form-tags.
{{Scripts}}           | Adds client-side validation and your uploaded JS-files. Put it at the end of the page.
{{CSS}}               | Adds your uploaded CSS. Put it between <head></head>.

### Inputfields
All your inputfields that should be saved after submission should have a data-fillable="true" attribute. This is to prevent mass-assignement vulnerabilities.

### License

The application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
