<?php

class BaseController extends Controller
{
	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		$this->beforeFilter('@isProfileCompleteFilter');
	}


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}

		View::share([
			'currentUser' => Auth::user(),
			'facebookFeed' => FeedReader::read(Config::get('feeds.facebookFeed'))->get_items(),
			't4sBlogFeed' => FeedReader::read(Config::get('feeds.blogFeed'))->get_items(),
			'twitterFeed' => $this->getTwitterFeed('twitterFeed'),
			'twitterHomeFeed' => $this->getTwitterFeed('twitterHomeFeed'),
			'displayAds' => getenv('DISPLAY_ADS')
		]);
	}

	protected function getTwitterFeed($feedname)
	{

		if (!Cache::has($feedname)) {

			if (strpos($feedname, 'Home')) {
				$timeline = Twitter::getHomeTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object'));
			} else {
				$timeline = Twitter::getUserTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object'));
			}

			Cache::add($feedname, $timeline, 60);
		}

		return Cache::get($feedname);
	}

	/**
	 * Before filter to validate the user has completed the profile
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function isProfileCompleteFilter()
	{
		if (Auth::user() and Auth::user()->profileIsIncomplete() and Route::currentRouteName() !== 'edit_profile') {
			Flash::error('You need to complete your profile before you can continue!');

			return Redirect::route('edit_profile');
		}
	}
}
