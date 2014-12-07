<?php

namespace Formboy\Http\Controllers\Form;

use Formboy\Domain\Forms\FormParser;
use Formboy\Domain\Forms\FormRepository;
use Formboy\Http\Controllers\Controller;
use Formboy\Http\Requests\FormCreateRequest;
use Formboy\Exceptions\InvalidTemplateException;
use Illuminate\Auth\Guard;

class FormController extends Controller {

    protected $formRepository;
    protected $formParser;
    protected $user;

    function __construct(FormRepository $formRepository, Guard $auth, FormParser $formParser)
    {
        $this->formRepository = $formRepository;
        $this->user = $auth->user();
        $this->formParser = $formParser;
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
            $form = $this->formRepository->saveForm($request->get('name'), $request->file('template_file'), $this->user);

            $id = $form->id;

            return redirect("form/$id/dashboard");

        } catch (InvalidTemplateException $ex) {

            return view('pages.form.create')->withErrors($ex->getMessage());

        } catch (\Exception $ex) {

            dd($ex);

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
    public function tijger() {
        dd(\Request::all());
    }
} 