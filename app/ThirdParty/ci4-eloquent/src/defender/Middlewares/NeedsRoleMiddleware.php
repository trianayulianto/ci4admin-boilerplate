<?php

namespace Artesaos\Defender\Middlewares;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class DefenderHasPermissionMiddleware.
 */
class NeedsRoleMiddleware extends AbstractDefenderMiddleware implements FilterInterface
{
    /**
     * @param \CodeIgniter\HTTP\RequestInterface $request
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->hasRoles($arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
