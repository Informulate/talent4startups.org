<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div style="margin: 0px auto; text-align: center; max-width: 600px">
    <img src="{{ asset('images/logo.png') }}" alt="Talent4Startups - Shape, Fuel, Build" id="t4s-logo" />
    <br/><br/>
    <div>
        {!! nl2br($body) !!}
    </div>
    <p style="font-size: .9em; font-style: italic">Tip: Quick engagement and consistent follow up while providing specific feedback, usually earns higher ratings form your team members. In other words, consistency and integrity can earn you some serious cred!</p>
    <hr/>
    <p>The T4S team is proudly sponsored by:</p>
    <ul id="t4s-sponsors">
        <li style="display: inline"><a href="http://www.vaco.com/" target="_blank"><img src="{{ asset('/images/partners/vaco.png') }}" alt="Vaco - Free Yourself" class="" height="95" /></a></li>
        <li style="display: inline"><a href="http://www.informulate.com" target="_blank"><img src="{{ asset('/images/partners/informulate.png') }}" alt="Informulate"  height="95" /></a></li>
        <li style="display: inline"><a href="http://move2create.com/" target="_blank"><img src="{{ asset('/images/partners/move2create.png') }}" alt="move2create - A Boutique Creative Agency" class="" height="95" /></a></li>
    </ul>
</div>
</body>
</html>
