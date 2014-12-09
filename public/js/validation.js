(function() {
  var errors, valid, validateEmailField, validateRequiredField;

  errors = [];

  valid = true;

  $('form').submit(function(event) {
    var emailField, emailFields, field, phoneFields, requiredFields, _i, _j, _len, _len1;
    valid = true;
    requiredFields = jQuery('.required');
    emailFields = jQuery('.validate-email');
    phoneFields = jQuery('.validate-phone');
    for (_i = 0, _len = requiredFields.length; _i < _len; _i++) {
      field = requiredFields[_i];
      validateRequiredField(field);
    }
    for (_j = 0, _len1 = emailFields.length; _j < _len1; _j++) {
      emailField = emailFields[_j];
      validateEmailField(emailField);
    }
    if (valid === false) {
      return event.preventDefault();
    }
  });

  validateRequiredField = function(field) {
    if (field.value.length === 0) {
      field.classList.add('error');
      field.classList.add('required-error');
      errors.push(field.name);
      return valid = false;
    }
  };

  validateEmailField = function(field) {
    if ((field.value != null) && !field.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
      field.classList.add('error');
      field.classList.add('email-error');
      errors.push(field.name);
      return valid = false;
    }
  };

}).call(this);
