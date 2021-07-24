<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use CodeIgniter\I18n\Time;

class VerificationController extends BaseController
{
	public function index()
	{
		return render('auth.verify');
	}

	public function resend()
	{
		$user = auth()->user();

		$user->sendEmailVerificationNotification();

		return $this->respondCreated([
			'message' => 'A fresh verification link has been sent to your email address'
		]);
	}

	/**
     * Mark the authenticated users email addres as verified.
     *
     * @return RedirectResponse
     */
    public function verify(string $hash)
    {
        // Check first if user email already verified
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->to(config('Auth')->home);
        }

        // Check if hash equal with current user email.
        if (! hash_equals($hash, sha1(auth()->user()->email))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        $signature = hash_hmac('sha256', auth()->user()->email, config('Encryption')->key);

        // Check signature key
        if (! hash_equals($signature, $this->request->getVar('signature'))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        // Check for token if expired
        if ($this->request->getVar('expires') < Time::now()->getTimestamp()) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.expired'));
        }

        auth()->user()->markEmailAsVerified();

        Events::trigger('fireVerifiedUser', auth()->user());

        return redirect()->to(config('Auth')->home);
    }
}
