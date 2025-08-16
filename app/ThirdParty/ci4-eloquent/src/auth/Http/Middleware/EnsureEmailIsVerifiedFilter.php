<?php

namespace Fluent\Auth\Http\Middleware;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Fluent\Auth\Contracts\VerifyEmailInterface;

class EnsureEmailIsVerifiedFilter implements FilterInterface
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
     * @param  array|null  $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = auth()->user();

        if (
            ! $user ||
            ($user instanceof VerifyEmailInterface &&
            ! $user->hasVerifiedEmail())
        ) {
            if ($request->isAjax() || (bool) $request->getJSON()) {
                throw new \Exception('Your email address is not verified', 403);
            }

            return redirect()->route('verification.notice');
        }

        return null;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param  array|null  $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
