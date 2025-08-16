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
			return $this->fail($this->validator->getErrors());
		}

		$request = (object) $this->request->getRawInput();

		$user = auth()->user();

		$user->name = $request->name;
		$user->email = $request->email;

		$user->password = empty($request->password)
			? $user->password
			: password_hash((string) $request->password, PASSWORD_BCRYPT);

		if ($user->isDirty('email')) {
			$user->email_verified_at = null;
		}

		$user->save();

		if ($user->wasChanged('email') && $user instanceof VerifyEmailInterface) {
			$user->sendEmailVerificationNotification();
		}

		return $this->respondCreated([
			'status' => $this->codes['created'],
			'message' => 'Profile updated successfuly',
			'data' => $user
		]);
	}
}
