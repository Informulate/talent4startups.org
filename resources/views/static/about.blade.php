@extends('app')

@section('content')
	<h2>About Us</h2>

	<p>
		<strong>{!! link_to_route('home', 'Talent4Startups.org') !!} (T4S)</strong> is an online, match-making platform
		that connects startup founders with career-minded talent, for free. The T4S mission is to help makers of all
		kinds: startup founders, volunteers to causes, hobbyists, skunk works, students etc. to find the shortest path
		in their professional trajectories. We do this by allowing them to learn, innovate, reuse, collaborate and thus
		empower themselves independently.
	</p>
	<p>
		We are community of builders, who support one another to sharpen our skills and bring ideas to market. We
		recognize that to do great things, we must learn. And the only way to learn is to do. As iron sharpens iron - we
		do better, together.
	</p>
	<p>
		We are a 501 c(3) non-profit. If you’d like to make a tax-deductible donation,
		please {!! link_to_route('contact', 'contact us') !!}.
	</p>

	<iframe width="1140" height="695" src="https://www.youtube.com/embed/JG74pXvY4Ug" frameborder="0" allowfullscreen></iframe>

	<h2>Community Manifesto</h2>

	<p>
		To quote Stan Garfield’s definition:
	</p>
	<blockquote>
		<p>Communities are groups of people who, for a specific subject, share a specialty, interest, concern, or a set
			of problems.</p>
	</blockquote>
	<p>
		Community members deepen their understanding of the subject by interacting on an ongoing basis, asking and
		answering questions, sharing information, reusing good ideas, solving problems for one another, and developing
		new and better ways of doing things.
	</p>

	<p>
		At T4S, we take that one step further by asserting the following:
	</p>

	<p>
		We Value
	</p>

	<ol>
		<li>Integrity & Honesty</li>
		<li>Sharing & Empathy</li>
		<li>Team work & Leadership by Example</li>
		<li>Initiative & Follow through</li>
		<li>Creativity & Experimentation</li>
	</ol>

	<p>
		We believe:
	</p>

	<ol>
		<li>In the basic equality of people</li>
		<li>Learning comes through doing</li>
		<li>Ideas need market validation early and often</li>
		<li>Value and profit is generated through free markets, customer understanding, and the power of well-executed
			ideas</li>
		<li>Anything worth doing, is worth doing well</li>

	</ol>

	<p>
		As a community member, I assert the following:
	</p>

	<ol>
		<li>I will give before I ask.</li>
		<li>I realize that many team members are working part time, and below competitive market rates out of a sense of
			collaboration, and will treat their time with respect.</li>
		<li>I accept my team members’ strengths and weaknesses, but will support and challenge them and myself to learn,
			grow and succeed.</li>
		<li>Where possible, I will offer autonomy to my team members in the execution of their tasks</li>
		<li>I will be quick to share and encourage, but slow to judge or criticize</li>
		<li>I recognize that deliverables are time bound. My commitments will be made explicitly using <a http://en.wikipedia.org/wiki/SMART_criteria>SMART </a>
			goals, and I will ask the same from my team members.</li>
		<li>I will, at all times, be honest and forthright in all my dealings. I will not promise anything that I cannot
			deliver.</li>
		<li>I will escalate issues as early as possible to minimize the impact of my shortfall on my team members who
			depend on me.</li>
		<li>I understand that T4S is a collaborative community, not a job or contract posting board. I will not spam, or
			aggressively market to others.</li>
		<li>I will do my part to keep my community strong and vibrant by maintaining current data on my profiles, rating
			those I work with, and not publishing any profiles that are not ready for the community to engage with.</li>
	</ol>

	<h3>Sponsors/Partners</h3>


	<img src="/images/partners/informulate_new.png" alt="Informulate" width="405px" class="center-block"/>
	<p>
		Informulate (<a href="http://www.informulate.com">www.informulate.com</a>) is a trusted partner to clients in
		higher education, startups, and small to mid-sized business. It operates two complementary lines of service -
		Business Consulting / Process Improvement using Lean and Agile methodologies, and Custom Development of
		data-driven, responsive web applications. Informulate partners with clients to fully articulate their vision,
		then to craft the optimal path, and finally to deliver high quality, agile software solutions.
	</p>

	<p>&nbsp;</p>

	<img src="/images/partners/vaco.png" alt="Vaco - Free Yourself" class="center-block"/>
	<p>
		Vaco builds best in class teams for start-ups to fortune 500 companies. We are a leading provider of talent
		acquisitions and management services. We integrate our outsourcing capability and consulting expertise to enable
		organizations to attract, engage and retain top talent in the areas of Technology, Finance, Accounting,
		Compliance and Audit, Sales, Operations, Marketing, Engineering, Human Resources and Administrative
		Professionals on a project or permanent placement basis.
	</p>

	<p>&nbsp;</p>
	<img src="/images/partners/move2create.png" alt="move2create - A Boutique Creative Agency" class="center-block"/>
	<p>Move2Create is a boutique creative agency specializing in brand creation, strategy and visual design.
		We are visual storytellers. And we rock at gettin’ down to the nitty-gritty of what makes a brand exceptional.</p>

	<p>&nbsp;</p>

	<h3>Contributors</h3>

	<div class="about">
		<p><strong>Frank Bennett</strong></p>

		<p>Frank has had a long career in software, product, and business development. He has a passion for helping
			people find creative ways to reach their potential in business and the community.</p>
	</div>

	<div class="about">
		<p><strong>Ramya Jeyaraj</strong></p>

		<p>Ramya lives in Seattle with her family. She likes to test, keeping software defects at bay. When not testing,
			Ramya likes to spend time with her family and enjoys outdoor activity especially when it does not rain in
			Seattle :)</p>
	</div>

	<div class="about">
		<p><strong>Jesus Fernandez</strong></p>

		<p>&nbsp;</p>
	</div>

	<div class="about">
		<p><strong>Mike Bernat</strong></p>

		<p>Back-end web developer living in Orlando, FL. Developing highly-available social networking platforms.</p>
	</div>

	<div class="about">
		<p><strong>Giselle Hernandez</strong></p>

		<p>Back-end web developer located in Colorado Springs, CO. She loves coding almost as much as she does fishing.</p>
	</div>


	@include('layouts.partials.socialshare')
@stop

@section('javascript')
	<script type="text/javascript">
		@if(getenv('APP_ENV') == 'prod')
			mixpanel.track("About:View");
		@endif
	</script>
@stop
