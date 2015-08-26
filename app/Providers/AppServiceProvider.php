<?php namespace App\Providers;

use FacebookInsights, FeedReader, Cache, Config, Twitter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$start = new \DateTime('2015-01-01');
		$end = new \DateTime();

		view()->share([
			'facebookPosts' => strtolower(getenv('FACEBOOK_ENABLE')) == true ? FacebookInsights::getPagePosts($start, $end, 2) : [],
			't4sBlogFeed' => FeedReader::read(Config::get('feeds.blogFeed'))->get_items(),
			'twitterFeed' => $this->getTwitterFeed('twitterFeed'),
			'twitterHomeFeed' => $this->getTwitterFeed('twitterHomeFeed'),
			'displayAds' => (strtolower(getenv('DISPLAY_ADS')) == 'true')
		]);
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

	private function getTwitterFeed($name)
	{

		if (!Cache::has($name)) {

			if (strpos($name, 'Home')) {
				$timeline = Twitter::getHomeTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object'));
			} else {
				$timeline = Twitter::getUserTimeline(array('screen_name' => Config::get('feeds.twitterScreenName'), 'count' => 3, 'format' => 'object'));
			}

			Cache::add($name, $timeline, 60);
		}

		return Cache::get($name);
	}

}
