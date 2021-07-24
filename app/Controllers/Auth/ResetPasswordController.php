<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use Illuminate\Support\Str;
use Fluent\Auth\Contracts\PasswordBrokerInterface;
use Fluent\Auth\Facades\Hash;
use Fluent\Auth\Facades\Passwords;

class ResetPasswordController extends BaseController
{
	public function index($token)
	{
		$email = $this->request->getGet('email');

		return render('auth.passwords.reset', [
			'email' => $email,
			'token' => $token
		]);
	}

    /**
     * Handle an incoming new password request.
     *
     * @return RedirectResponse
     */
    public function reset()
    {
        $request = (object) $this->request->getPost();

        if (! $this->validate(static::rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Passwords::reset(
            static::credentials($request),
            function ($user) use ($request) {
        		$user->password = Hash::make($request->password);
                
                $user->setRememberToken(Str::random(60));

		        $user->save();

                Events::trigger('firePasswordReset', $user);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status === PasswordBrokerInterface::PASSWORD_RESET
            ? $this->respondCreated(['message' => lang($status)])
            : $this->fail(['error' => lang($status)]);
    }

    /**
     * Rules for validation.
     *
     * @return array
     */
    protected static function rules()
    {
        return [
            'email'                 => 'required|valid_email',
            'password'              => 'required|min_length[8]',
            'password_confirmation' => 'matches[password]',
        ];
    }

    /**
     * Get the request credentials.
     *
     * @param object $request
     * @return array
     */
    protected static function credentials($request)
    {
        return [
            'token'                 => $request->token,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];
    }
}
