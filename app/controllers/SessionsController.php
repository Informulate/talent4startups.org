<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\SignInForm;
use Informulate\Users\User;
use Informulate\Users\Profile;
use Informulate\Tags\Tag;

class SessionsController extends BaseController {

	/**
	 * @var SignInForm
	 */
	private $signInForm;

	/**
	 * Constructor
	 *
	 * @param SignInForm $signInForm
	 */
	function __construct(SignInForm $signInForm)
	{
		$this->signInForm = $signInForm;

		$this->beforeFilter('guest', ['except' => 'destroy']);
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	 
	 /**
	 * Save the user.
	 */
	public function store()
	{
		$formData = Input::only('email', 'password');
		$this->signInForm->validate($formData);

		if (Auth::attempt($formData)) {
			Flash::message('Welcome back to Talent4Startups!');
		    $profile = Auth::user()->profile;
			if(is_object($profile) && sizeof($profile)>0){
			$tags = Auth::user()->profile->tags;
			if(!empty($profile->first_name) && !empty($profile->last_name) && (is_object($tags) && sizeof($tags)>0)){
			//redirect to home page if profile has First Name, Last Name and Skills
			return Redirect::intended('');
			}
			}
			// if profile is missing, redirect to edit profile page
			return Redirect::intended('profile');
		}
		//if wrong email/password entered
		return Redirect::to('login')->with('email',$formData['email'])->with('error','Wrong email/password entered.');
	}

	/*
	* Login with linked in
	*/
	public function loginWithLinkedin(){
		// get data from input
        $code = Input::get( 'code' );
        $linkedinService = OAuth::consumer( 'Linkedin' );
        if ( !empty( $code ) ) {
            // This was a callback request from linked-in, get the token
            $token = $linkedinService->requestAccessToken( $code );
            // Send a request with it. Please note that XML is the default format.
			$result = json_decode($linkedinService->request('/people/~?format=json'), true);
			$email  = json_decode($linkedinService->request('/people/~/email-address?format=json'), true);

			$user = User::where('email','=',$email)->first();

			if(sizeof($user)==0){
			// if not a registered user, insert new user as talent
			$user = new User;
			$user->email = $email;
			$user->save();

			//create user profile and store user_type in profile table
			$profile = new Profile(array('user_type'=>'talent','active'=>1, 'first_name'=>$result['firstName'], 'last_name'=>$result['lastName']));
			$profile = $user->profile()->save($profile);
			}
			Auth::login($user);
			Flash::message('Welcome to Talent4Startups');
			$profile = $user->profile;
			if(is_object($profile) && sizeof($profile)>0){
			$tags = $user->profile->tags;
			if(!empty($profile->first_name) && !empty($profile->last_name) && (is_object($tags) && sizeof($tags)>0)){
			//redirect to home page if profile has First Name, Last Name and Skills
			return Redirect::intended('');
			}
			}
			return Redirect::to('profile');

        } // if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));
            // return to linkedin login url
            return Redirect::to( (string)$url );
        }
	}

	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}
}
