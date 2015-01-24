<div id="footer" class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="footer-headline"><h5>Recent Articles</h5></div>
            <?php $count = count($t4sBlogFeed) < 3 ? count($t4sBlogFeed) : 3 ; ?>
            @for ($i = 0; $i < $count; $i++)
                <a href="{{ $t4sBlogFeed[$i]->get_link() }}">{{ $t4sBlogFeed[$i]->get_title() }}</a>
                <p>
                    {{ $t4sBlogFeed[$i]->get_description() }}
                    {{ $t4sBlogFeed[$i]->get_date('j F Y | g:i a') }}
                </p>

                <hr>
            @endfor
        </div>
        <div class="col-sm-3">
            <div class="footer-headline"><h5>Tweets</h5></div>
            <?php $count = count($twitterFeed) < 3 ? count($twitterFeed) : 3 ; ?>
            @for ($i = 0; $i < $count; $i++)
                <p>
                    {{ $twitterFeed[$i]->text }}, <a target="_blank" href = "http://twitter.com/{{ $twitterFeed[$i]->user->screen_name  }}/status/{{ $twitterFeed[$i]->id }}">View tweet</a>
                </p>
                <p>
                    {{ $twitterFeed[$i]->user->name }} (&#64;{{ $twitterFeed[$i]->user->screen_name }}), {{ date("d F Y",strtotime($twitterFeed[$i]->created_at)) }} | {{ date("g:ha",strtotime($twitterFeed[$i]->created_at)) }}
                </p>
                @if ($i + 1 < $count )
                    <hr>
                @endif
            @endfor
            <div class="footer-headline"><h5>Tweets we follow</h5></div>
            <?php $count = count($twitterHomeFeed) < 3 ? count($twitterHomeFeed) : 3 ; ?>
            <?php if (!is_array($twitterHomeFeed)) { $count = 0; } ?>
            @for ($i = 0; $i < $count; $i++)
                <p>
                    {{ $twitterHomeFeed[$i]->text }}, <a target="_blank" href = "http://twitter.com/{{ $twitterHomeFeed[$i]->user->screen_name  }}/status/{{ $twitterHomeFeed[$i]->id }}">View tweet</a>
                </p>
                <p>
                    {{ $twitterHomeFeed[$i]->user->name }} (&#64;{{ $twitterHomeFeed[$i]->user->screen_name }}), {{ date("d F Y",strtotime($twitterHomeFeed[$i]->created_at)) }} | {{ date("g:ha",strtotime($twitterHomeFeed[$i]->created_at)) }}
                </p>

                <hr>
            @endfor

        </div>
        <div class="col-sm-3">
            <div class="footer-headline"><h5>Facebook Posts</h5></div>
            <?php $count = count($facebookFeed) < 3 ? count($facebookFeed) : 3 ; ?>
            @for ($i = 0; $i < $count; $i++)
                {{ $facebookFeed[$i]->get_description() }}
                {{ $facebookFeed[$i]->get_date('j F Y | g:i a') }}
                <hr>
            @endfor

        </div>
        <div class="col-sm-3">
            <div class="footer-headline"><h5>Contact</h5></div>
            <p><i class="glyphicons glyphicons-envelope"></i><a href="mailto:info@talent4startups.org"> info@talent4startups</a></p>
            <p><i class="glyphicons glyphicons-circle-question-mark"></i><a href="/contact"> Contact Form</a></p>
            <p><i class="glyphicons glyphicons-earphone"></i> 866.222.2307</p>
        </div>
    </div>
</div>
