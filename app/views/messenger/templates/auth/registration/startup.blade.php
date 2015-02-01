@extends('messenger.templates.base')

@section('subject')
    Welcome to Talent4Startups, {{ $user->profile->first_name }}!
@endsection

@section('body')
Hi {{ $user->profile->first_name }},

Welcome to Talent4Startups! You've just taken a big step towards making your startup dream a reality. You are a much more attractive to investors once you get market validation for your concept. If you bring commitment and respect, the T4S community will support you with your project execution.

To start, make sure you <b>update your startup profile</b> with the specific roles tagged with the skills you will need to execute your project. Then, go to our talent listing page, and use our filters to <b>find the people</b> whose tags and location match your needs. Once you find someone that look interesting, simply <b>click the INVITE button</b>. Its that easy to start building your team.

If you do not hear back from invitees, or if you have any questions at all do let us know at <a href="mailto:questions@talent4Startups.org">questions@talent4Startups.org</a>.

We wish you all the best! Oh, and about your project.
@endsection