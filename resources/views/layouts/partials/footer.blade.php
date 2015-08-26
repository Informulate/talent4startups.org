<div id="footer" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-sm-3" style="display: none">
				<div class="footer-headline"><h5>Recent Articles</h5></div>
				<?php $count = count($t4sBlogFeed) < 3 ? count($t4sBlogFeed) : 3; ?>
				@for ($i = 0; $i < $count; $i++)
					<a href="{{ $t4sBlogFeed[$i]->get_link() }}" target="_blank">{{ $t4sBlogFeed[$i]->get_title() }}</a>
					<p>
						{{ $t4sBlogFeed[$i]->get_description() }}
						{{ $t4sBlogFeed[$i]->get_date('j F Y | g:i a') }}
					</p>
				@endfor
			</div>
			<div class="col-sm-3">
				<div class="footer-headline"><h5>Tweets</h5></div>
				<?php $count = count($twitterFeed) < 2 ? count($twitterFeed) : 2; ?>
				<?php if (!is_array($twitterFeed)) {
					$count = 0;
				} ?>
				@for ($i = 0; $i < $count; $i++)
					<p>
						{{ $twitterFeed[$i]->text }}, <a target="_blank"
														 href="http://twitter.com/{{ $twitterFeed[$i]->user->screen_name  }}/status/{{ $twitterFeed[$i]->id }}">View
							tweet</a>
					</p>
					<p>
						{{ $twitterFeed[$i]->user->name }} (&#64;{{ $twitterFeed[$i]->user->screen_name }}
						), {{ date("d F Y",strtotime($twitterFeed[$i]->created_at)) }}
						| {{ date("g:ha",strtotime($twitterFeed[$i]->created_at)) }}
					</p>
				@endfor
			</div>
            <div class="col-sm-3 col-sm-offset-2">
                <div class="footer-headline"><h5>Tweets we follow</h5></div>
                <?php $count = count($twitterHomeFeed) < 2 ? count($twitterHomeFeed) : 2; ?>
                <?php if (!is_array($twitterHomeFeed)) {
                    $count = 0;
                } ?>
                @for ($i = 0; $i < $count; $i++)
                    <p>
                        {{ $twitterHomeFeed[$i]->text }}, <a target="_blank"
                                                             href="http://twitter.com/{{ $twitterHomeFeed[$i]->user->screen_name  }}/status/{{ $twitterHomeFeed[$i]->id }}">View
                            tweet</a>
                    </p>
                    <p>
                        {{ $twitterHomeFeed[$i]->user->name }} (&#64;{{ $twitterHomeFeed[$i]->user->screen_name }}
                        ), {{ date("d F Y",strtotime($twitterHomeFeed[$i]->created_at)) }}
                        | {{ date("g:ha",strtotime($twitterHomeFeed[$i]->created_at)) }}
                    </p>
                @endfor
            </div>
			<div class="col-sm-3" style="display: none">
				<div class="footer-headline"><h5>Facebook Posts</h5></div>
				<?php $count = count($facebookFeed) < 3 ? count($facebookFeed) : 3; ?>
				@for ($i = 0; $i < $count; $i++)
					{!! $facebookFeed[$i]->get_description() !!}
					{{ $facebookFeed[$i]->get_date('j F Y | g:i a') }}
				@endfor

			</div>
			<div class="col-sm-2 col-sm-offset-2">
				<div class="footer-headline"><h5>Contact</h5></div>
				<p><a href="mailto:info@talent4startups.org"> info@talent4startups</a></p>
				<p>866.222.2307</p>
			</div>
		</div>
        <div class="row footer-banner">
			<div class="col-sm-12">
				<hr/>
			</div>
            <div class="col-sm-offset-1 col-sm-2 footer-text">
                <a href="/privacy">Privacy Policy</a>
            </div>
            <div class="col-sm-offset-1 col-sm-1 footer-text">
                <a href="/faq">FAQ</a>
            </div>
            <div class="col-sm-offset-1 col-sm-2 footer-text">
                <a href="/contact">Contact Form</a>
            </div>
            <div class="col-sm-offset-1 col-sm-2 footer-text">
                <a href="/termsofservice">Terms of Service</a>
            </div>
        </div>
        <div class="row">
            <p class="text-center">&copy;{{ date('Y') }} Talent4Startups</p>
        </div>
	</div>
</div>
