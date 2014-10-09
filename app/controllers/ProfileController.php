<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProfileForm;
use Informulate\Forms\ResetForm;
use Informulate\Core\CommandBus;
use Informulate\Users\UpdateProfileCommand;
use Informulate\Users\User;

class ProfileController extends BaseController {

	 use CommandBus;

	/**
	 * @var ProfileForm
	 */
	private $profileForm;
        
        /**
	 * @var ResetForm
	 */
	private $resetForm;

	/**
	 * Constructor
	 *
	 * @param ProfileForm $profileForm
         * @param ResetForm $resetForm
	 */
	function __construct(ProfileForm $profileForm,ResetForm $resetform)
	{
		$this->profileForm = $profileForm;
		$this->resetForm   = $resetform;
	}
	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function edit()
	{
		return View::make('profile.edit');
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->profileForm->validate(Input::all());

		extract(Input::only('first_name', 'last_name'));

		$this->execute(
			new UpdateProfileCommand(Auth::user(), $first_name, $last_name)
		);

		return Redirect::route('projects.create');
	}
	/**
	 * Load view for reset password for logged in users
	 */
	public function resetPasswordForm(){
		if(!Auth::id()) {
		//redirect to login , if user not logged in
		return Redirect::to('login');
		}	
		return View::make('profile.reset_password');
	}



	/**
	 * Reset requested password for user
	 */
	public function resetPassword()
	{
		$this->resetForm->validate(Input::all());

		extract(Input::only('old_password', 'new_password','password_confirmation'));

		if($new_password!=$password_confirmation) {
	 	 	//confrim password not match
	 	 	return redirect::route('reset_password')->with('error','Confirm password not 							match');
		}

		//check if user entered old password correct
		$user = User::find(Auth::id());

        	if(Hash::check($old_password, $user->password)){
            		//old password correct
	 		try{
	 		 //save user with new password, display success message

                            $user->password = $new_password;
                            $user->save();
                            Flash::message('Your password has been reset successfully!');
                            return redirect::route('reset_password');		
			}catch(Exception $e){
	  		// fail to update user, generate error and load view

                            Flash::message('Error in reset password. Try again later!');
                            return redirect::route('reset_password')->with('error','Error in reset password. 						Try again later!'); 
			}
     		}
      		 else{
	 		 // generate error if old password is incorrect
          		 return redirect::route('reset_password')->with('error','Old password is 				 incorrect!'); 
        	    }
 	 }
}
