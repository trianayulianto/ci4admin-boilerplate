<?php

namespace Fluent\Auth\Http\Middleware;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Fluent\Auth\Facades\Auth;

class RedirectAuthenticatedFilter implements FilterInterface
{
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		if (empty($arguments)) {
            $arguments = [null];
        }

        foreach ($arguments as $guard) {
            if (Auth::guard($guard)->check()) {
	            if ($request->isAjax() || !!($request->getJSON())) {
	                return Services::response()
		            	->setStatusCode(429)
		            	->setJSON([
				            'status' => 429,
				            'message' => [
				            	'error' => 'Too Many Requests'
				            ]
				        ]);
	            }

                return redirect()->to(config('Auth')->home);
            }
        }
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// 
	}
}
