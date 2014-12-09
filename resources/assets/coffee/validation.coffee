errors = []
valid = true

$('form').submit (event) ->
  valid = true

  requiredFields = jQuery '.required'
  emailFields = jQuery '.validate-email'
  phoneFields = jQuery '.validate-phone'

  validateRequiredField field for field in requiredFields
  validateEmailField emailField for emailField in emailFields

  if valid is false
    event.preventDefault()

validateRequiredField = (field) ->
  if field.value.length is 0
    field.classList.add 'error'
    field.classList.add 'required-error'

    errors.push field.name
    valid = false

validateEmailField = (field) ->
  if field.value? and not field.value.match /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    field.classList.add 'error'
    field.classList.add 'email-error'

    errors.push field.name
    valid = false