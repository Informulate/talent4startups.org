<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProfileForm;
use Informulate\Forms\ResetForm;
use Informulate\Core\CommandBus;
use Informulate\Users\UpdateProfileCommand;
use Informulate\Users\User;
use Informulate\Describes\Describe;
use Informulate\Skills\Skill;

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
	 * @var Skill
	 */
	private $skill;
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
		$this->beforeFilter('auth');
	}
	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function edit()
	{
		$describes=Describe::lists('name','id'); 
		$skills=Skill::lists('name','id');  		
		return View::make('profile.edit')->with( 'describes',$describes)->with( 'skills',$skills);
	}
	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->profileForm->validate(Input::all());
		extract(Input::only('first_name', 'last_name','image', 'skills'));		 
	 /*	$destinationPath = public_path().'/img/'; 
			if (Input::hasFile('image')) {
				 	$file            = Input::file('image'); 
			        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
			        $uploadSuccess   = $file->move($destinationPath, $filename);
			//		Input::file('photo')->move($destinationPath);
			        $image=$filename; 
	        
	   	    }		*/
		$userData=$this->execute(
			new UpdateProfileCommand(Auth::user(), $first_name, $last_name)
		);
		//$this->skill->newUserSkills($userData,$skills); //assign skills to users
	 	return Redirect::route('projects.create');
	} 
	/**
	 * Load view for reset password for logged in users
	 */
	public function resetPasswordForm(){
			
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
