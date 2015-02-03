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
			'currentUser' => Auth::user(),
			'facebookFeed' => FeedReader::read('https://www.facebook.com/feeds/page.php?format=rss20&id=178420851973')->get_items(),
			't4sBlogFeed' => FeedReader::read('http://blog.talent4startups.org/?feed=rss2')->get_items(),
			'twitterFeed' => Twitter::getUserTimeline(array('screen_name' => 't4startups', 'count' => 3, 'format' => 'object')),
			'twitterHomeFeed' => Twitter::getHomeTimeline(array('screen_name' => 't4startups', 'count' => 3, 'format' => 'object')),
			'displayAds' => getenv('DISPLAY_ADS')

		]);
	}

}
