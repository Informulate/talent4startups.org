@extends('app')

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
        Check out our {{ link_to_route('manifesto', 'community manifesto') }}.
    </p>

    <h3>Sponsors/Partners</h3>


    <img src="/images/partners/informulate.png" alt="Informulate" class="center-block" />
    <p>
        Informulate (<a href="http://www.informulate.com">www.informulate.com</a>) is a trusted partner to clients in higher education, startups, and small to mid-sized business. It operates two complementary lines of service - Business Consulting / Process Improvement using Lean and Agile methodologies, and Custom Development of data-driven, responsive web applications. Informulate partners with clients to fully articulate their vision, then to craft the optimal path, and finally to deliver high quality, agile software solutions.
    </p>

    <p>&nbsp;</p>

    <img src="/images/partners/vaco.png" alt="Vaco - Free Yourself" class="center-block" />
    <p>
        Vaco builds best in class teams for start-ups to fortune 500 companies.  We are a leading provider of talent acquisitions and management services.  We integrate our outsourcing capability and consulting expertise to enable organizations to attract, engage and retain top talent in the areas of Technology, Finance, Accounting, Compliance and Audit, Sales, Operations, Marketing, Engineering, Human Resources and Administrative Professionals on a project or permanent placement basis.
    </p>

    <p>&nbsp;</p>

    <img src="/images/partners/sevenality.png" alt="Sevenality - branding. design. forward." class="center-block" />
    <p>
        Sevenality (<a href="http://www.sevenality.com">www.sevenality.com</a>) is a Brand Strategy and Design Firm dedicated to the community. Founded with the mission of providing solutions and not only services, we aim to inspire, help, build and deliver experiences that meet and exceed the needs of any project. Sevenality works closely with clients to create and execute brand strategies focused on creating sustainable futures and to inspire, motivate, as well as deliver an exceptional experience.
    </p>

    <h3>Contributors</h3>

    <div class="about row">
        <p><strong>Frank Bennett</strong></p>
        <p>Frank has had a long career in software, product, and business development. He has a passion for helping people find creative ways to reach their potential in business and the community.</p>
    </div>

    <div class="about row">
        <p><strong>Ramya Jeyaraj</strong></p>
        <p>Ramya lives in Seattle with her family. She likes to test, keeping software defects at bay. When not testing, Ramya likes to spend time with her family and enjoys outdoor activity especially when it does not rain in Seattle :)</p>
    </div>

    <div class="about row">
        <p><strong>Jesus Fernandez</strong></p>
        <p></p>
    </div>

    <div class="about row">
        <p><strong>Ravi Gehlot</strong></p>
        <p>For over 8 years, Ravi worked as a Software Developer for several industries where he developed a passion for assisting clients with care and a focus on exceeding needs.</p>
    </div>

    <div class="about row">
        <p><strong>Mike Bernat</strong></p>
        <p>Back-end web developer living in Orlando, FL. Developing highly-available social networking platforms.</p>
    </div>

    @include('layouts.partials.socialshare')
@stop
