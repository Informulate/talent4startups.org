<?php 
class PasswordController extends BaseController {
 
  public function remind()
  {
    return View::make('password.remind');
  }

  public function request()
	{
	  $credentials = array('email' => Input::get('email'),'password' => Input::get('password')); 
		//$response = Password::remind($credentials);
		 $response = Password::remind($credentials, function($message) {
	        $message->subject('Reset your password (Talent4startups).');
	    });
		if($response=='reminders.user')	{
			return Redirect::back()->with('error', 'Please enter valid email !');
		}
	   Flash::message('Reset password link has been sent to your email.');
	   return View::make('password.remind');
	}
	public function reset($token)
	{
	  return View::make('password.reset')->with('token', $token);
	}
	public function update()
	{
		 $credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);
		$response = Password::reset($credentials, function($user, $password)
		{
		//	$user->password = Hash::make($password);
			$user->password = $password ;
			$user->save();
		});			 
		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}
}
?>