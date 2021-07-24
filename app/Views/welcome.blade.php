<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4!</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

	<!-- CSS Reset -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
	
	<!-- STYLES -->
	<link rel="stylesheet" href="{{ base_url().'/css/hp/milligram.min.css' }}">
	<link rel="stylesheet" href="{{ base_url().'/css/hp/custom.css' }}">
</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

	<div class="menu">
		<ul>
			<li class="logo">
				<a href="https://codeigniter.com" target="_blank" style="font-size: 14pt; color: #9b4dca;">
					<strong><span style="color: darkorange;">CI</span><span style="color: #9b4dca;">Loq</span></strong>
				</a>
			</li>
			<li class="menu-toggle">
				<button onclick="toggleMenu();">&#9776;</button>
			</li>
			<li class="menu-item hidden"><a href="{{ route_to('homepage') }}">Home</a></li>
			@auth
				<li class="menu-item hidden"><a href="{{ route_to('dashboard.index') }}">Dashboard</a></li>
				<li class="menu-item hidden"><a href="#" id="logout">Logout</a></li>
			@else
				<li class="menu-item hidden"><a href="{{ route_to('login') }}">Login</a></li>
				<li class="menu-item hidden"><a href="{{ route_to('register') }}">Register</a></li>
			@endauth
		</ul>
	</div>

	<div class="heroe" style="padding-top: 4rem">

		<div class="row items">
			<div class="column column-50">
				<h1>Welcome to <span style="color: darkorange;">CI</span><span style="color: #9b4dca;">Loq</span> based on 
				<br>CodeIgniter {{ CodeIgniter\CodeIgniter::CI_VERSION }}</h1>

				<h2>CodeIgniter 4 with Eloquent + BladeOne + JWT Auth</h2>

				<button href="" type="button" class="button-primary">Github</button>
			</div>

			<div class="column column-50">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" style="max-width: 480px; display: flex; justify-content: right">
					<title>#102_travelling_twocolour</title>
					<path d="M81.77,83.39c-28.67,17.47-45.66,49.51-43,83C40.18,183.48,46.54,200,63.35,209c44.83,24,240.55,24.45,269.51-18s18.19-102.84-44.8-128C233.46,41.18,155.82,38.3,81.77,83.39Z" fill="#e6e6e6" opacity="0.3"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#ffd200" stroke-miterlimit="10" stroke-width="2"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2" opacity="0.08"/><path d="M159.26,145.74s-18.34,7.36-12.41,28.68,6.48,23.63,19.71,22.32,4.66-22.32,4.66-22.32Z" fill="#ffd200"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#ed8936"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#fff" opacity="0.46"/><ellipse cx="200.42" cy="272.36" rx="154.08" ry="11.83" fill="#e6e6e6" opacity="0.45"/><path d="M134.79,246.33s-4.45,3.22-8.54.91-7.67.77-4.87,4.13,14.8,5,14.8,5l4.51-7.28Z" fill="#ed8936"/><path d="M215.08,260.56s1.94,5.15,6.62,5.47,6,4.88,1.79,6.14-15.12-4-15.12-4l.26-8.57Z" fill="#ed8936"/><path d="M79.19,260.08s-10.59-2.9-12.89-12.75c0,0,16.41-3.32,16.87,13.62Z" fill="#ed8936" opacity="0.58"/><path d="M80.49,259s-7.4-11.7-.89-22.64c0,0,12.48,7.93,6.93,22.66Z" fill="#ed8936" opacity="0.73"/><path d="M82.4,259s3.9-12.35,15.72-14.69c0,0,2.21,8-7.65,14.73Z" fill="#ed8936"/><polygon points="74.72 258.75 76.86 273.44 90.38 273.5 92.37 258.83 74.72 258.75" fill="#24285b"/><path d="M156.2,53.77s1.74,6.3,4.27,10a3.28,3.28,0,0,0,4.58.82c1.83-1.3,3.93-3.59,3.41-7.08l-.15-6a5.88,5.88,0,0,0-4.6-5C159.34,45.28,155,50,156.2,53.77Z" fill="#f4a28c"/><polygon points="169.43 54.63 177.9 74.3 166.73 78.19 165.05 62.32 169.43 54.63" fill="#f4a28c"/><path d="M170.86,55.92h0a.62.62,0,0,1-.23.72,4.34,4.34,0,0,1-5.25-.1,5.45,5.45,0,0,1-2.08-5.6,25.94,25.94,0,0,1-5.48,2.52,6,6,0,0,1-2,.32l-3.28-4s-4.23-3.66-1.89-5.67,4.76.61,6.11-2.44,1.54-4.07,4.27-3.72.83,3.12,4.53,1.7,4.36.08,5,1.75a3.1,3.1,0,0,1-.12,1.82A20.1,20.1,0,0,0,170.86,55.92Z" fill="#24285b"/><path d="M164.66,56.6s-.83-2.37,1-2.85,3.06,3,.77,4.16Z" fill="#f4a28c"/><path d="M157.5,57.68l-.83,3A1,1,0,0,0,157.85,62l2.51-.43Z" fill="#f4a28c"/><rect x="289.35" y="173.73" width="16.36" height="5.3" fill="#24285b"/><path d="M165.31,64.43s1.44-.49,3.72-3.33c0,0,1.05,4.15-3.26,8Z" fill="#ce8172" opacity="0.31"/><path d="M162.12,76.62l6.43-1.16a90.83,90.83,0,0,0,8.92-2.08c11-3.14,43.37-10.53,52.58,8.2,11.16,22.69-7.47,96.3-7.47,96.3h-51s-10.41-30.66-25.29-49.62S121,88.21,162.12,76.62Z" fill="#ed8936"/><path d="M152.37,79.92s-2.56,16.32,19.86,4l-5.75-8A58,58,0,0,0,152.37,79.92Z" opacity="0.08"/><path d="M94.92,139.7c-10.16-3.16-11.68-17-2.47-22.37a25.2,25.2,0,0,1,10.9-3.2c17.08-1.26,46.18-2.85,46.18-2.85s17.52,5.7,14.77,14.24-15.08-5.06-15.08-5.06S116.66,146.46,94.92,139.7Z" fill="#f4a28c"/><rect x="144.58" y="110.56" width="6.04" height="12.3" transform="translate(-14.69 21.47) rotate(-7.93)" fill="#24285b"/><rect x="143.84" y="109.5" width="6.04" height="3.82" transform="matrix(0.99, -0.14, 0.14, 0.99, -13.96, 21.32)" fill="#ffd200"/><path d="M166.48,75.84s-7.76,7.14,1.21,8.67,9.78-11.13,9.78-11.13Z" fill="#f4a28c"/><path d="M171.63,177.88l-38.45,68.45,9.93,6.91s21.24-35.45,46.53-53.26a6.38,6.38,0,0,1,9.72,3.27c6.84,21.15,7.42,58,7.42,58H218.5l4.08-83.34Z" fill="#24285b"/><path d="M171.63,177.88s19.15-15,25.92-36.41a6.57,6.57,0,0,1,11.08-2.37l18.2,19.68,3.67-20.57L217.19,96.09,192,79.92l-5,19.51Z" opacity="0.08"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#ffd200"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#fff" opacity="0.46"/><path d="M196.37,93.76c-5-12,8.93-27.14,21-22.46,10.32,4,21.35,12.84,27.34,30.64C258.94,144.25,291,164.7,291,164.7s16.36,2.7,16.36,8.65-19.34,0-19.34,0-50.2-20.83-76.24-54.3C204,109,199.22,100.59,196.37,93.76Z" fill="#f4a28c"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#ed8936"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#fff" opacity="0.46"/><rect x="271.49" y="198.46" width="52.16" height="67.53" fill="#ffd200"/><rect x="278.47" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="309.43" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="280.14" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="293.95" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="306.92" y="211.01" width="7.25" height="40.35" opacity="0.08"/><circle cx="222.58" cy="34.77" r="21.04" fill="#24285b"/><polygon points="214.44 34.77 196.44 52.7 220.3 43.18 214.44 34.77" fill="#24285b"/><rect x="220.3" y="25.3" width="3.51" height="11.08" fill="#fff"/><rect x="220.3" y="39.43" width="3.51" height="3.51" fill="#fff"/>
				</svg>
			</div>
		</div>

	</div>

</header>

<!-- CONTENT -->

<div class="content">
	
	<section class="wrapper">

		<div class="container">
			<div class="column column-100" style="padding-left: 8px;">
				<form action="{{ route_to('/') }}" method="GET">
				  	<fieldset>
				    	<div class="row">
				    		<div class="column column-75">
					    		<input type="text" name="search" value="{{ request()->getGet('search') ?? '' }}" placeholder="CJ Patoilo" id="nameField">
				    		</div>
				    		<div class="column">
					    		<button class="button-primary" type="submit">Search</button>
				    		</div>
				    	</div>
					</fieldset>
				</form>
			</div>
		</div>

		<div class="container">
			<div class="column column-100">
				<table>
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($users as $i => $item)
							<tr>
								<td>{{ $i + $users->firstItem() }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->email }}</td>
								<td>{{ timeParser($item->created_at)->toLocalizedString('MMM d, yyyy') }}</td>
							</tr>
						@empty
							<tr style="text-align: center;">
								<td colspan="4">Data Not Found</td>
							</tr>
						@endforelse
					</tbody>
				</table>
				<!-- Clear any float  -->
				<div class="clearfix">
				  	<!-- Float either directions -->
				  	<div class="float-right">
						{!! paginator($users->appends(['search' => request()->getGet('search')])) !!}
				  	</div>
				</div>
			</div>
		</div>

	</section>

</div>

<div class="further">

	<section class="wrapper">

		<div class="container">

			<h1>Go further</h1>

			<h2>
				<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><rect x='32' y='96' width='64' height='368' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='224' x2='240' y2='224' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='400' x2='240' y2='400' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><rect x='112' y='160' width='128' height='304' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><rect x='256' y='48' width='96' height='416' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><path d='M422.46,96.11l-40.4,4.25c-11.12,1.17-19.18,11.57-17.93,23.1l34.92,321.59c1.26,11.53,11.37,20,22.49,18.84l40.4-4.25c11.12-1.17,19.18-11.57,17.93-23.1L445,115C443.69,103.42,433.58,94.94,422.46,96.11Z' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/></svg>
				Learn
			</h2>

			<p>The User Guide contains an introduction, tutorial, a number of "how to"
				guides, and then reference documentation for the components that make up
				the framework. Check the <a href="https://codeigniter4.github.io/userguide"
				target="_blank">User Guide</a> !</p>

			<h2>
				<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
				Discuss
			</h2>

			<p>CodeIgniter is a community-developed open source project, with several
				 venues for the community members to gather and exchange ideas. View all
				 the threads on <a href="https://forum.codeigniter.com/"
				 target="_blank">CodeIgniter's forum</a>, or <a href="https://codeigniterchat.slack.com/"
				 target="_blank">chat on Slack</a> !</p>

			<h2>
				 <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><line x1='176' y1='48' x2='336' y2='48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><line x1='118' y1='304' x2='394' y2='304' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M208,48v93.48a64.09,64.09,0,0,1-9.88,34.18L73.21,373.49C48.4,412.78,76.63,464,123.08,464H388.92c46.45,0,74.68-51.22,49.87-90.51L313.87,175.66A64.09,64.09,0,0,1,304,141.48V48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
				 Contribute
			</h2>

			<p>CodeIgniter is a community driven project and accepts contributions
				 of code and documentation from the community. Why not
				 <a href="https://codeigniter.com/en/contribute" target="_blank">
				 join us</a> ?</p>

		</div>

	</section>

</div>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
	<div class="environment">

		<p>Page rendered in {elapsed_time} seconds</p>

		<p>Environment: {{ ENVIRONMENT }}</p>

	</div>

	<div class="copyrights">

		<p>&copy; {{ date('Y') }} CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
			open source licence.</p>

	</div>

</footer>

<!-- SCRIPTS -->
<script src="{{ base_url('js/manifest.js') }}"></script>
<script src="{{ base_url('js/vendor.js') }}"></script>
<script src="{{ base_url('js/app.js') }}"></script>
<script src="{{ base_url('js/custom.js') }}"></script>
@stack('scripts')

<script type="text/javascript">
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("hidden");
		}
	}

    $(document).on('click', '#logout', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route_to('logout') }}",
            type: "POST",
            success: (response) => {
            	Cookies.remove('token');

                return setTimeout(() => {
                    window.location = "{{ route_to('homepage') }}";
                }, 1500);
            }
        });
    });
</script>
<!-- -->

</body>
</html>
