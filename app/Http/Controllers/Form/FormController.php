<?php

namespace Formboy\Http\Controllers\Form;

use Formboy\Domain\Forms\FormRepository;
use Formboy\Http\Controllers\Controller;
use Formboy\Http\Requests\FormCreateRequest;
use Formboy\Exceptions\InvalidTemplateException;
use Illuminate\Auth\Guard;

class FormController extends Controller {

    protected $formRepository;
    protected $user;

    function __construct(FormRepository $formRepository, Guard $auth)
    {
        $this->formRepository = $formRepository;
        $this->user = $auth->user();
    }

    /**
     * Show a form to upload and create a new form.
     *
     * @Get("form/create")
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
     * @return Response
     */
    public function postCreate(FormCreateRequest $request)
    {
        try {
            $this->formRepository->saveForm($request->get('name'), $request->file('template_file'), $this->user);

            return 'Posted!';

        } catch (InvalidTemplateException $ex) {
            dd($ex);

            return view('pages.form.create')->withErrors($ex->getMessage());

        } catch (\Exception $ex) {
            dd($ex);

            return view('pages.form.create')->withErrors('An unexpected exception occured. Please contact an administrator.');

        }
    }
} 