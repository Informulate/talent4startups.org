@extends('layouts.default')

@section('content')
    <h2>About Us</h2>

    <p>
        <strong>{{ link_to_route('home', 'Talent4Startups.org') }} (T4S)</strong> is an online, match-making platform that connects startup founders with career-minded talent, for free. The T4S mission is to help makers of all kinds: startup founders, volunteers to causes, hobbyists, skunk works, students etc. to find the shortest path in their professional trajectories. We do this by allowing them to learn, innovate, reuse, collaborate and thus empower themselves independently.
    </p>
    <p>
        We are community of builders, who support one another to sharpen our skills and bring ideas to market. We recognize that to do great things, we must learn. And the only way to learn is to do. As iron sharpens iron - we do better, together.
    </p>
    <p>
        We are a 501 c(3) non-profit. If you’d like to make a tax-deductible donation, please {{ link_to_route('contact', 'contact us') }}.
    </p>
    <p>
        Check out our <>community manifesto <link to community Manifesto>.
    </p>

    @include('layouts.partials.socialshare')
@stop