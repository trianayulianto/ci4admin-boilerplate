<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Fluent\Auth\Contracts\PasswordBrokerInterface;
use Fluent\Auth\Facades\Passwords;

class ForgotPasswordController extends BaseController
{
	public function index()
	{
		return render('auth.passwords.email');
	}

    /**
     * Handle an incomming password reset link request.
     *
     * @return RedirectResponse
     */
    public function send()
    {
        $request = (object) $this->request->getPost();

        if (!$this->validate(['email' => 'required|valid_email'])) {
            return $this->fail($this->validator->getErrors());
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Passwords::sendResetLink([
            'email' => $request->email,
        ]);

        return $status === PasswordBrokerInterface::RESET_LINK_SENT
            ? $this->respondCreated(['message' =>lang($status)])
            : $this->fail(['error' => lang($status)]);
    }
}
