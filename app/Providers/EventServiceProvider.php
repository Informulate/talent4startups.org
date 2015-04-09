<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
		'SocialiteProviders\Manager\SocialiteWasCalled' => [
			'SocialiteProviders\LinkedIn\LinkedInExtendSocialite@handle',
		],
        'App\Events\NewMessage' => [
            'App\Handlers\Events\Messages\NewMessage'
        ],
        'App\Events\StartupRated' => [
            'App\Handlers\Events\Messages\StartupRated'
        ],
        'App\Events\UserRated' => [
            'App\Handlers\Events\Messages\UserRated'
        ],
        'App\Events\StartupCreated' => [
            'App\Handlers\Events\Messages\StartupCreated'
        ],
        'App\Events\UserAppliedToJoinStartup' => [
            'App\Handlers\Events\Messages\UserAppliedToJoinStartup'
        ],
        'App\Events\UserDeniedToJoinStartup' => [
            'App\Handlers\Events\Messages\UserDeniedToJoinStartup'
        ],
        'App\Events\UserJoinedStartup' => [
            'App\Handlers\Events\Messages\UserJoinedStartup'
        ],
        'App\Events\UserLeftStartup' => [
            'App\Handlers\Events\Messages\UserLeftStartup'
        ],
        'App\Events\ProfileCreated' => [
            'App\Handlers\Events\Messages\ProfileCreated'
        ],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
