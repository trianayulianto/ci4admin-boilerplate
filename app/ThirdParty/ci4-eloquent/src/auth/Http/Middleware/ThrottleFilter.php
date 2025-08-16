<?php

namespace Fluent\Auth\Http\Middleware;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ThrottleFilter implements FilterInterface
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
        $throttler = Services::throttler();

        $reqCount = $arguments[0] ?? 60;
        $reqTime = $arguments[1] ?? 1;

        if (! is_int((int) $reqCount) || ! is_int((int) $reqTime)) {
            throw new \Exception('Invalid Arguments');
        }

        if (
            $throttler->check(
                $request->getIPAddress(),
                $reqCount,
                $reqTime * MINUTE
            ) === false
        ) {
            if ($request->isAjax() || (bool) $request->getJSON()) {
                return Services::response()
                    ->setStatusCode(429)
                    ->setJSON([
                        'status' => 429,
                        'message' => [
                            'error' => 'Too Many Requests',
                        ],
                    ]);
            }

            return redirect()->back()->with('error', 'Too Many Requests')->withInput();
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
