<?php

namespace Fluent\Laraci\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Illuminate\Pagination\Paginator;

final class PaginationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		if ($request->getMethod() === 'get') {

            Paginator::currentPathResolver(function () use ($request) {
                return (string) $request->getUri()->getPath();
            });

            Paginator::queryStringResolver(function () use ($request) {
                return (string) $request->getUri()->getQuery();
            });

            Paginator::currentPageResolver(function ($pageName = 'page') use ($request) {
                $page = $request->getGet($pageName);

                if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                    return (int) $page;
                }

                return 1;
            });

        }
    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 
    }
}