<?php namespace Formboy\Http\Middleware;

use Closure;
use Formboy\Domain\Forms\FormRepository;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Routing\Route;

class FormAuthentication implements Middleware {

    protected $auth;

    protected $route;

    protected $formRepository;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, Route $route, FormRepository $formRepository)
    {
        $this->auth = $auth;
        $this->route = $route;
        $this->formRepository = $formRepository;
    }

	/**
	 * Handle an incoming request.
     * Returns 403 if the user tries to view a form that isn't his.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(!$this->canAccess()) {
            abort(403);
        }

        return $next($request);
	}

    /**
     * Check if the current user can access the requested form.
     *
     * @return bool
     */
    protected function canAccess() {
        $id = $this->route->getParameter('id');

        $form = $this->formRepository->getForm($id);

        if($form->user_id == $this->auth->getUser()->id) {
            return true;
        } else {
            return false;
        }
    }
}
