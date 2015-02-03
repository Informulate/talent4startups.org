<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		View::share([
			'currentUser' 		=> Auth::user(),
			'facebookFeed'		=> FeedReader::read(Config::get('feeds.facebookFeed'))->get_items(),
			't4sBlogFeed' 		=> FeedReader::read(Config::get('feeds.blogFeed'))->get_items(),
			'twitterFeed'	 	=> Twitter::getUserTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object')),
			'twitterHomeFeed' 	=> Twitter::getHomeTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object')),
			'displayAds' 		=> getenv('DISPLAY_ADS')
		]);
	}

}
