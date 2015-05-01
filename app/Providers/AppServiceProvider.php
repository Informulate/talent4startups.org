<?php namespace App\Providers;

use Awjudd\FeedReader\Facades\FeedReader;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Thujohn\Twitter\Facades\Twitter;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->share([
			'facebookFeed' => FeedReader::read(Config::get('feeds.facebookFeed'))->get_items(),
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

}
