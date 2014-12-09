<?php

namespace Formboy\Http\Controllers\Form;

use Formboy\Domain\Forms\FormParser;
use Formboy\Domain\Forms\FormRepository;
use Formboy\Forms\FormSubmissions\FormSubmissionRepository;
use Formboy\Http\Controllers\Controller;
use Formboy\Http\Requests\FormCreateRequest;
use Formboy\Exceptions\InvalidTemplateException;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class FormController extends Controller {

    protected $formRepository;
    protected $formParser;
    protected $user;
    protected $formSubmissionRepository;

    function __construct(FormRepository $formRepository, Guard $auth, FormParser $formParser, FormSubmissionRepository $formSubmissionRepository)
    {
        $this->formRepository = $formRepository;
        $this->user = $auth->user();
        $this->formParser = $formParser;
        $this->formSubmissionRepository = $formSubmissionRepository;
    }

    /**
     * Show a form to upload and create a new form.
     *
     * @Get("form/create")
     *
     * @Middleware("auth")
     *
     * @return Response
     */
    public function getCreate()
    {
        return view('pages.form.create');
    }

    /**
     * Process the uploaded form.
     *
     * @Post("form/create")
     *
     * @Middleware("auth")
     *
     * @return Response
     */
    public function postCreate(FormCreateRequest $request)
    {
        try {
            $templateFile = $request->file('template_file');
            $completePage = $request->file('complete_page');
            $cssFile = $request->file('css_file');
            $jsFile = $request->file('js_file');

            $form = $this->formRepository->saveForm($request->get('name'), $templateFile, $completePage, $cssFile, $jsFile, $this->user);

            return redirect("form/$form->id/dashboard");

        } catch (InvalidTemplateException $ex) {

            return view('pages.form.create')->withErrors($ex->getMessage());

        } catch (\Exception $ex) {

            return view('pages.form.create')->withErrors('An unexpected exception occured. Please contact an administrator.');

        }
    }

    /**
     * Show a page to manage your form.
     *
     * @get("form/{id}/dashboard")
     *
     * @Middleware("auth")
     * @Middleware("Formboy\Http\Middleware\FormAuthentication")
     *
     * @return Response
     */
    public function getFormDashboard($id) {
        $form = $this->formRepository->getForm($id, true);

        return view('pages.form.dashboard')->with('form', $form);
    }

    /**
     * Show an overview of all forms for the current user.
     *
     * @get("form/overview")
     *
     * @Middleware("auth")
     *
     * @return Repsonse
     */
    public function getOverview() {
        $forms = $this->formRepository->getFormsByUser($this->user->id);

        return view('pages.form.overview')->with('forms', $forms);
    }

    /**
     * Renders a form.
     *
     * @get("form/{id}")
     *
     * @param $id
     */
    public function getForm($id) {
        $form = $this->formRepository->getForm($id);

        return $this->formParser->renderForm($form);
    }

    /**
     * Submit a form.
     *
     * @post("form/submit")
     *
     * @param $id
     */
    public function submit(Request $request) {
        $input = $request->all();

        $form = $this->formRepository->getForm($input['form_id'], true);

        $data = array();
        $errors = array();
        $valid = true;

        foreach($form->fields as $field) {
            if(isset($input[$field->name])) {
                $data[$field->id] = $input[$field->name];
            } else {
                if ($field->requied == true) {
                    $valid = false;
                    $errors[] = "The field $field->name is required.";
                }
            }
        }

        if($valid) {
            $this->formSubmissionRepository->saveSubmission($data, $form);

            return redirect("form/$form->id/complete");
        } else {
            return $this->formParser->renderForm($input['form_id'], $errors);
        }
    }

    /**
     * @get("form/{id}/complete")
     */
    public function showCompletePage($id) {
        $form = $this->formRepository->getForm($id);
        return $this->formParser->renderCompletePage($form);
    }
} 