@extends('messenger.templates.base')

@section('subject')
    Welcome to Talent4Startups, {{ $user->profile->first_name }}!
@endsection

@section('body')
Hi {{ $user->profile->first_name }},

Welcome to Talent4Startups! You've taken a big step towards taking control of your career. Get ahead of the competition with real world experience If you bring commitment, the T4S community will challenge you to be accountable for your skill development.

To start, make sure you <b>tag your profile</b> with the specific skills you are looking to develop. Then, go to our startup listing page, and use our filters to <b>find the projects</b> you want to contribute to. Once you find projects that look interesting, please make sure you read and understand the requirements and conditions. If you like what you see, simply <b>click the APPLY button</b>. Its that easy.

If you do not hear back from the founder, or if you have any questions at all do let us know at <a href="mailto:info@talent4startups.org">info@talent4startups.org</a>.

We wish you all the best! Oh, and please tell your friends.
@endsection