<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Hi {{ $recipient['first_name'] }}!</h2>
<p>Contained are your weekly matches</p>
<div>
    @foreach($startupMatches as $match)
        <h4>
            {{ $match->startup->name }}
        </h4>
        <p>{{ $match->startup->description  }}</p>
    @endforeach
</div>
<p>If you would like to reply to them please log in to <a href="http://talent4startups.org">http://talent4startups.org</a>. If you have any questions at all do let us know at <a href="mailto:info@talent4Startups.org">info@talent4Startups.org</a>.</p>
<p>We wish you all the best! Oh, and please tell your friends.</p>
</body>
</html>
