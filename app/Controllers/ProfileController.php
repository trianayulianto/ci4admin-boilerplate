<?php

namespace App\Controllers;

use Fluent\Auth\Contracts\VerifyEmailInterface;

class ProfileController extends BaseController
{
	public function index()
	{
		return render('modules.profile.index');
	}

	public function update()
	{
		$rules = [
			'name' => 'required|min_length[3]',
			'email' => 'required|valid_email|is_unique[users.email,id,'.user_id().']',
			'password' => 'permit_empty|min_length[8]',
			'repeat_password' => 'required_with[password]|matches[password]',
		];

		if (!$this->validate($rules)) {
			return $this->respond([
				'status' => 'fail',
				'message' => 'Validation error',
				'errors' => $this->validator->getErrors()
			], 200);
		}

		$request = (object) $this->request->getRawInput();

		$user = auth()->user();

		$user->name = $request->name;
		$user->email = $request->email;

		$user->password = !empty($request->password)
			? password_hash($request->password, PASSWORD_BCRYPT)
			: $user->password;

		if ($user->isDirty('email')) {
			$user->email_verified_at = null;
		}

		$user->save();

		if ($user->wasChanged('email') && $user instanceof VerifyEmailInterface) {
			$user->sendEmailVerificationNotification();

			return $this->respond([
				'status' => 'success',
				'message' => 'Profile updated successfuly',
			])
			->deleteCookie('token');
		}

		return $this->respond([
			'status' => 'success',
			'message' => 'Profile updated successfuly'
		]);
	}
}
