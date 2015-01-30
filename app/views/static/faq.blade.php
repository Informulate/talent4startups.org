@extends('layouts.default')

@section('content')
    <h2>FAQ</h2>

    <ol>
        <li>
            <p><strong>What is T4S?</strong></p>
            <p>Talent4Startups.org (T4S) is an online, match-making platform that connects startup founders with career-minded talent, for free. Read more {{ link_to_route('about', 'About Us') }}. </p>
        </li>
        <li>
            <p><strong>As a startup founder, how does it help me?</strong></p>
            <p>Many startups never take off because of a vicious cycle: you need something tangible to get funding, you need resources to build things, but its hard to get resources without the funding in the first place. T4S gives you that impetus to break the cycle. Collaborate with like-minded resources to build out your concept, fine tune your strategy, test it in the market, and use real results to attract investment. Now you have no excuse. The universe awaits&hellip; Make that ripple!</p>
        </li>
        <li>
            <p><strong>As a student/professional, how does it help me?</strong></p>
            <p>Students or recent grads find it hard to get placed because of lack of experience. Professionals get typecast in their current jobs and cannot easily get experience in the latest techniques in their field. We can help. From now on, let there be no limit to your career aspirations. Find the right projects to polish the specific skill you are looking for, bulk up your resume, and forge real relationships (not just contacts) by delivering results. With each skill you acquire, with every level you attain… your ambitions get closer to reality.</p>
        </li>
        <li>
            <p><strong>How much does it cost?</strong></p>
            <p>T4S is completely free to use, and basic functionality will stay free. We may introduce some additional features in the future for an extra, optional fee.</p>
        </li>
        <li>
            <p><strong>What kind of commitment do I need to make?</strong></p>
            <p>Your commitment is to your team members in terms of how many hours you can do and how long you can sustain that commitment. We recommend a minimum of 10 hrs/week for at least 6 weeks to have any meaningful impact to a project.</p>
        </li>
        <li>
            <p><strong>I have a full time job, how can I contribute?</strong></p>
            <p>At T4S, you are often working with other people who also have more than one commitment. As long as you are aligning with our <>community manifesto<link to community manifesto> your contributions will still be valuable.</p>
        </li>
        <li>
            <p><strong>I don’t have experience, how can I contribute?</strong></p>
            <p>T4S is specifically designed to help people who are trained (paid or self) to practice their skills in real world projects. Familiarize yourself with our <> community manifesto <link> and make sure that you set appropriate and conservative expectations with your team. In an upcoming version, we will introduce mentors into the community but in the meantime make sure to seek out your own mentors who can help you get past roadblocks.</p>
        </li>
        <li>
            <p><strong>What do I need to bring?</strong></p>
            <p>Make sure you have what you need to produce the output you are committing to deliver. Typically this would mean having a computer or software appropriate to the tasks you intend to perform. If there are certain project-specific investments (like printing) that need to happen for your deliverables, it is appropriate to seek a commitment from the founder to pay for these items before you execute.</p>
        </li>
        <li>
            <p><strong>As a startup founder, how can I get funding?</strong></p>
            <p>Any investor will tell you, the best way to get funding is to have market validation. An idea without execution is not an investable business. In a future version, we will support investor centric events and matching but in the meantime, ensure that you are getting paying customers for your product/service in order to attract investment.</p>
        </li>
        <li>
            <p><strong>As a contributor to a project/startup, do I get paid?</strong></p>
            <p>What and how you get paid is between you and the startup/project founder, you should clear that up before you start work. However, this is NOT a freelancing marketplace. We ask that you think of the work you do as being a reward in itself. The focus on experience, connections, and learning is what sets T4S apart and allows high trust collaboration.</p>
        </li>
        <li>
            <p><strong>What features are coming up?</strong></p>
            <p>We have a slew of enhancements planned from a knowledge base, local and online resources, mentors, gamification, etc. coming up in 2015. If you want a specific feature, request one by {{ link_to_route('contact', 'contacting us') }}</p>
        </li>
        <li>
            <p><strong>I have a startup idea, but where do I start?</strong></p>
            <p>Create a profile for your {{ link_to_route('startup_create', 'startup here') }}. Your profile is your face to the world, so pretty it up with a simple, clear message, images and preferably videos. Remember to tag your startup with appropriate keywords and to set up the roles (with its own tags) you need to execute fully. You can then search our database of talented contributors and invite them to your project. Once you get your team together, you can use existing tools such as Github, Zoho, basecamp etc., to manage the project and take the idea to market. Refer to our {{ link_to_route('knowledgebase', 'knowledge base for more advise') }} on managing your project.</p>
        </li>
        <li>
            <p><strong>I have a startup idea, but I’m afraid that someone will steal it</strong></p>
            <p>In our experience, this is an overblown risk at early stages. Ideas are rarely stolen until they are validated in the market, at which point you can move quicker than competitors since you have a head start. You can seek to protect yourself using patents, copyright or NDAs. The latter being the most cumbersome if you are trying to gather a team. NDAs tend to be viewed as restricting future work and projects that a team member may engage in, and you might have difficulty persuading them to sign. As startup founder, this is your decision on balancing protection versus speed.</p>
        </li>
        <li>
            <p><strong>I want to work on something relevant, where do I start?</strong></p>
            <p>Create a profile for {{ link_to_route('startup_create', 'yourself here') }}. Your profile is your face to the world, so pretty it up with a simple, clear message, images and preferably videos.</p>
        </li>
        <li>
            <p><strong>I love it, how do I spread the word?</strong></p>
            <p>You can help spread the word by <>tweeting us<twitter>, or sharing us. You can also bring attention to your own profile by using the sharing options on your personal or startup profile page.</p>
            @include('layouts.partials.socialshare')
        </li>
    </ol>

@stop