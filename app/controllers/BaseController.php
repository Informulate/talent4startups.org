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
			'twitterFeed'	 	=> $this->getTwitterFeed('twitterFeed'),
			'twitterHomeFeed' 	=> $this->getTwitterFeed('twitterHomeFeed'),
			'displayAds' 		=> getenv('DISPLAY_ADS')
		]);
	}

	protected function getTwitterFeed($feedname) {

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
}
