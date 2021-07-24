<?php 

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Config\Services;

class AuthenticateController extends BaseController
{
	public function index()
	{
		return render('auth.login');
	}

	public function login()
	{
		// Validate this credentials request.
        if (! $this->validate(['email' => 'required|valid_email', 'password' => 'required'])) {
            return $this->fail($this->validator->getErrors());
        }

        $credentials = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        if (! $token = auth()->attempt($credentials)) {
            return $this->fail('Auth failed!', 401);
        }

        return $this->respondWithToken($token);
	}

	public function logout()
	{
        auth()->logout();

        return $this->respondDeleted(['message' => 'Successfully logged out']);
	}

    /**
     * Refresh a token.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \CodeIgniter\Http\Response
     */
    protected function respondWithToken($token)
    {
        return $this->respondCreated([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL(),
        ]);
    }
}
