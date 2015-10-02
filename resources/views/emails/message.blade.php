
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        #t4s-sponsors li {
            display: inline;
        }

        #t4s-tip {
            font-style: italic;
            font-size: .9em;
        }

        #t4s-email-container {
            margin: 0px auto;
            text-align: center;
            max-width: 600px;
        }
    </style>
</head>
<body>
<div id="t4s-email-container">
    <img src="{{ asset('images/logo.png') }}" alt="Talent4Startups - Shape, Fuel, Build" id="t4s-logo" />
    <h2>Hi {{ $recipient['first_name'] }}!</h2>
    <p>You are receiving this email because someone contacted you on Talent4Startups. Here is what they said:</p>
    <div>
        {!! nl2br($body) !!}
    </div>
    <p id="t4s-tip">Tip: Quick engagement and consistent follow up while providing specific feedback, usually earns higher ratings form your team members. In other words, consistency and integrity can earn you some serious cred!</p>
    <hr/>
    <p>The T4S team is proudly sponsored by:</p>
    <ul id="t4s-sponsors">
        <li><a href="http://www.vaco.com/" target="_blank"><img src="{{ asset('/images/partners/vaco.png') }}" alt="Vaco - Free Yourself" class="" /></a></li>
        <li><a href="http://www.informulate.com" target="_blank"><img src="{{ asset('/images/partners/informulate.png') }}" alt="Informulate" /></a></li>
        <li><a href="http://move2create.com/" target="_blank"><img src="{{ asset('/images/partners/move2create.png') }}" alt="move2create - A Boutique Creative Agency" class="" /></a></li>
    </ul>
</div>
</body>
</html>
