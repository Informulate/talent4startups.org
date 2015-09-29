<div class="container-footer">
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 hidden-xs">
					<h5 class="footer-headline">Tweets</h5>
					<?php $count = count($twitterFeed) < 2 ? count($twitterFeed) : 2; ?>
					<?php if (!is_array($twitterFeed)) {
						$count = 0;
					} ?>
					@for ($i = 0; $i < $count; $i++)
						<p>
							{{ $twitterFeed[$i]->text }}, <a class="pull-right" target="_blank"
															 href="//twitter.com/{{ $twitterFeed[$i]->user->screen_name  }}/status/{{ $twitterFeed[$i]->id }}">View
								tweet</a>
						</p>
						<p>
							{{ $twitterFeed[$i]->user->name }} (&#64;{{ $twitterFeed[$i]->user->screen_name }}
							), {{ date("d F Y",strtotime($twitterFeed[$i]->created_at)) }}
							| {{ date("g:ha",strtotime($twitterFeed[$i]->created_at)) }}
						</p>
					@endfor
				</div>
	            <div class="col-lg-3 hidden-xs">
	                <h5 class="footer-headline">Tweets we follow</h5>
	                <?php $count = count($twitterHomeFeed) < 2 ? count($twitterHomeFeed) : 2; ?>
	                <?php if (!is_array($twitterHomeFeed)) {
	                    $count = 0;
	                } ?>
	                @for ($i = 0; $i < $count; $i++)
	                    <p>
	                        {{ $twitterHomeFeed[$i]->text }}, <a class="pull-right" target="_blank"
	                                                             href="//twitter.com/{{ $twitterHomeFeed[$i]->user->screen_name  }}/status/{{ $twitterHomeFeed[$i]->id }}">View
	                            tweet</a>
	                    </p>
	                    <p>
	                        {{ $twitterHomeFeed[$i]->user->name }} (&#64;{{ $twitterHomeFeed[$i]->user->screen_name }}
	                        ), {{ date("d F Y",strtotime($twitterHomeFeed[$i]->created_at)) }}
	                        | {{ date("g:ha",strtotime($twitterHomeFeed[$i]->created_at)) }}
	                    </p>
	                @endfor
	            </div>
				<div class="col-lg-3 hidden-xs">
					<h5 class="footer-headline">Facebook Posts</h5>
					@foreach($facebookPosts as $post)
						<p>{{ $post->message }}</p>
						<p>{{ preg_replace('/(T)|(:\d\d\+)|(0000)/', ' ', $post->created_time) }} <a class="pull-right" target="_blank" href="https://www.facebook.com/talent4Startups">More Posts</a></p>
					@endforeach
				</div>
				<div class="col-lg-3 col-xs-12">
					<h5 class="footer-headline">Contact</h5>
					<p><a href="mailto:info@talent4startups.org">info@talent4startups</a></p>
					<p class="text-primary">866.222.2307</p>
				</div>
			</div>
		</div>
	</div>
	<div id="footer-bar">
		<div class="row footer-banner">
			<ul class="breadcrumb">
				<li role="presentation"><a href="/privacy">Privacy Policy</a></li>
				<li role="presentation"><a href="/faq">FAQ</a></li>
				<li role="presentation"><a href="/contact">Contact Form</a></li>
				<li role="presentation"><a href="/termsofservice">Terms of Service</a></li>
				<li role="presentation"><a href="#">&copy; {{ date('Y') }} Talent4Startups</a></li>
			</ul>
		</div>
	</div>
</div>
