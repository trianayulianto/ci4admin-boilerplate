<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;
use Fluent\Auth\Contracts\VerifyEmailInterface;

class RegisterController extends BaseController
{
	public function index()
	{
		return render('auth.register');
	}

	public function register()
	{
		if (!$this->validate($this->rules())) {
			return $this->fail($this->validator->getErrors());
		}

		$data = (array) $this->request->getPost();

		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

		DB::beginTransaction();
		try {
			$user = User::create($data);

			// send email if $user instanceof VerifyEmailInterface
			// and User more then one
			if ($user instanceof VerifyEmailInterface && ($count = (User::count()) > 1)) {
				$user->sendEmailVerificationNotification();
			}

			if ($count) {
				$user->attachRole(Role::latest()->first());
			}
			// first register will forced as verified account and setted as superuser
			else {
				$user->markEmailAsVerified();
				$user->attachRole(Role::first());
			}

			$accessToken = auth()->login($user);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			return $this->fail(['error' => $e->getMessage()]);
		}

		return $this->respondWithToken($accessToken);
	}

	/**
     * Rules for validation.
     *
     * @return array
     */
	public function rules()
	{
		return [
			'name' => 'required|min_length[3]',
			'email' => 'required|valid_email|is_unique[users.email]',
			'password' => 'required|min_length[8]',
			'repeat_password' => 'required|min_length[8]|matches[password]',
		];
	}

	/**
     * Create response.
     *
     * @return array
     */
    public function respondWithToken($token)
    {
        return $this->respondCreated([
			'message' => 'Yay! Create account successfuly',
			'data'	  => [
	            'access_token' => $token,
	            'token_type'   => 'bearer',
	            'expires_in'   => auth('api')->factory()->getTTL()
			]
        ]);
    }
}
