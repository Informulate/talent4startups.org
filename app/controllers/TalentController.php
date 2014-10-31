<?php

use Informulate\Users\User;
use Informulate\Users\Profile;
use Informulate\Tags\Tag;
use Informulate\Users\UserRepository;
use Informulate\Describes\Describe;

class TalentController extends BaseController {
	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * @param UserRepository $userRepository
	 */
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Display a list of active talents
	 *
	 * @return $this
	 */
	public function index()
	{
		$talents = $this->userRepository->findActiveTalents();
		$describes = Describe::lists('name','id');
		return View::make('talent.index')->with('talents', $talents)->with('describes',$describes);
	}

	/**
	 * Return list of talents searched/found
	 *
	 * @return talent\index
	 */
	protected function findTalents()
	{
		if(Request::ajax()) {
		//continue if AJAX request
		$tag = !empty(Input::get('tag'))?Tag::where('name', '=', Input::get('tag'))->first():'';
		$tagID = is_object($tag) && sizeof($tag)>0?$tag->id:0;
		$talents =  User::whereHas('profile', function ($q) use ($tagID){
		$q->where('active', '=', true);
		Input::get('describe')!=0?$q->where('describe', '=',Input::get('describe')):null;
		if(!empty(Input::get('tag'))){
		//if user entered tag
		$profiles= Profile::whereHas('tags', function($query) use ($tagID){
		$query->where('tags.id', '=', $tagID);
		})->get()->lists('id');
		$q->whereIn('id',count($profiles)>0?$profiles:array(-1));
		}})->paginate(16);
		return View::make('talent.index-talent')->with('talents', $talents)->render();
		}
	}

	/**
	 * Display a talent
	 *
	 * @param $talent
	 * @return \Illuminate\View\View
	 */
	public function show($talent)
	{
		$talent = User::where('username', '=', $talent)->firstOrFail();

		return View::make('talent.show')->with('talent', $talent);;
	}
}
