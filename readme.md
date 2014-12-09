## Formboy

Formboy is a web application that allows front-end developers to upload a fully functional and styled webform without having to write a single line of PHP.

The application is being build on the Laravel framework (version 5). For it's requirements check http://laravel.com/docs.

## Installation
TBA

## Usage
1) Build your form in plain HTML, CSS and Javascript.
2) Upload your form.
3) You're done!

### Required tokens
In order to make your form functional we need you to include some tokens.

#### {{FormErrors}}
This token is needed to display errors on your form.

Example:
```html
<div class="errors">{{FormErrors}}</div>
```

#### {{FormSubmit}}
We need this to let the form know where to submit the data. Just put it in the action-tag of your form.

Example:
```html
<form method="POST" action="{{FormSubmit}}">
```

#### {{Magic}}
With the magic token we add some extra magic to your form like CSRF-protection. Put it between the <form></form> tags. Just above the submit-button is a nice spot.

Example:
```html
{{Magic}}

<input type="submit" value="Submit">
```

#### {{CSS}}
Put this token where the CSS-files should be.

#### {{Scripts}}
Put this token where the Javascript-files should be.

### License

The application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
