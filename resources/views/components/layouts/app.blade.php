<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{env("APP_NAME")}}</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
  </head>

  
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

	<nav id="header" class="fixed w-full z-10 top-0">

		<div id="progress" class="h-1 z-20 top-0" style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>

		<div class="w-full md:max-w-4xl mx-auto flex flex-wrap items-center justify-between mt-0 py-3">

			<div class="pl-4">
				<a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="{{route('home')}}">
					{{env("APP_NAME")}}
				</a>
			</div>

			<div class="block lg:hidden pr-4">
				<button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-green-500 appearance-none focus:outline-none">
					<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<title>Меню</title>
						<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
					</svg>
				</button>
			</div>

			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent z-20" id="nav-content">
				<ul class="list-reset lg:flex justify-end flex-1 items-center">
					@php
            $currentRoute = Route::currentRouteName();
          @endphp               
          @guest
          <li class="mr-3">
						<a class="inline-block no-underline text-gray-600 py-2 px-4 @if($currentRoute === 'auth.login') text-gray-900 font-bold @endif" href="{{route('auth.login')}}">Авторизация</a>
					</li>
          <li class="mr-3">
						<a class="inline-block text-gray-600 no-underline py-2 px-4 @if($currentRoute === 'auth.register') text-gray-900 font-bold @endif" href="{{route('auth.register')}}">Регистрация</a>
					</li>  
          @endguest     
          @auth
					<li class="mr-3">
						<a class="inline-block text-gray-600 no-underline py-2 px-4 @if($currentRoute === 'my-pastes') text-gray-900 font-bold @endif" href="{{route('my-pastes')}}">Мои пасты</a>
					</li>
          <li class="mr-3">
						<a class="inline-block text-gray-600 no-underline py-2 px-4" href="{{route('auth.logout')}}">Выйти</a>
					</li>
          @endauth
				</ul>
			</div>
		</div>
	</nav>

	<!--Container-->
	<div class="container w-full md:max-w-3xl mx-auto py-20">
    @if(session('error'))
        <div class="w-full bg-red-700 text-white rounded-lg py-5 px-5">
            {{session('error')}}
        </div>
    @endif
    {{$slot}}
	</div>
	<!--/container-->

	<footer class="bg-white border-t border-gray-400 shadow">
		<div class="container max-w-4xl mx-auto flex py-8">

			<div class="w-full mx-auto flex flex-wrap">
				<div class="flex w-full md:w-1/2 ">
					<div class="px-8">
						<h3 class="font-bold text-gray-900">About</h3>
						<p class="py-4 text-gray-600 text-sm">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
						</p>
					</div>
				</div>

				<div class="flex w-full md:w-1/2">
					<div class="px-8">
						<h3 class="font-bold text-gray-900">Social</h3>
						<ul class="list-reset items-center text-sm pt-3">
							<li>
								<a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
							</li>
							<li>
								<a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
							</li>
							<li>
								<a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
							</li>
						</ul>
					</div>
				</div>
			</div>



		</div>
	</footer>

	<script>
		/* Progress bar */
		//Source: https://alligator.io/js/progress-bar-javascript-css-variables/
		var h = document.documentElement,
			b = document.body,
			st = 'scrollTop',
			sh = 'scrollHeight',
			progress = document.querySelector('#progress'),
			scroll;
		var scrollpos = window.scrollY;
		var header = document.getElementById("header");
		var navcontent = document.getElementById("nav-content");

		document.addEventListener('scroll', function() {

			/*Refresh scroll % width*/
			scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
			progress.style.setProperty('--scroll', scroll + '%');

			/*Apply classes for slide in bar*/
			scrollpos = window.scrollY;

			if (scrollpos > 10) {
				header.classList.add("bg-white");
				header.classList.add("shadow");
				navcontent.classList.remove("bg-gray-100");
				navcontent.classList.add("bg-white");
			} else {
				header.classList.remove("bg-white");
				header.classList.remove("shadow");
				navcontent.classList.remove("bg-white");
				navcontent.classList.add("bg-gray-100");

			}

		});


		//Javascript to toggle the menu
		document.getElementById('nav-toggle').onclick = function() {
			document.getElementById("nav-content").classList.toggle("hidden");
		}
	</script>

</body>

</html>