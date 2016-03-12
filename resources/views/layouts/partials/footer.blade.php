<div class="container-footer">
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 hidden-xs">
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
				<div class="col-lg-4 hidden-xs">
					<h5 class="footer-headline">Facebook Posts</h5>
					@foreach($facebookPosts as $post)
						<p>{{ isset($post->message) ? $post->message : '' }}</p>
						<p>{{ isset($post->story) ? $post->story : '' }}</p>
						<p>{{ preg_replace('/(T)|(:\d\d\+)|(0000)/', ' ', $post->created_time) }} <a class="pull-right" target="_blank" href="https://www.facebook.com/talent4Startups">More Posts</a></p>
					@endforeach
				</div>
				<div class="col-lg-4 col-xs-12">
					<h5 class="footer-headline">Get in touch</h5>
					<p>
						<a class="text-larger" href="https://www.facebook.com/talent4Startups"><i class="glyphicons social social-facebook"></i></a>
						<a class="text-larger" href="http://twitter.com/T4Startups"><i class="glyphicons social social-twitter"></i></a>
						<a class="text-larger" href="https://www.youtube.com/channel/UCZh9_oyYxIJVwWGpCvlp3IA"><i class="glyphicons social social-youtube"></i></a>
						<a class="text-larger" href="mailto:info@talent4startups.org"><i class="glyphicons social social-e-mail"></i></a>
					</p>
					<p><a href="mailto:info@talent4startups.org">info@talent4startups</a></p>
					<p>866.222.2307</p>
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
