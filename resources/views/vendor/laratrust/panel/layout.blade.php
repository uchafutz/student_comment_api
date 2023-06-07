<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>DashBoard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ mix('laratrust.css', 'vendor/laratrust') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

</head>

<body>
    <div>
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center h-16">
                    @guest
                    @else
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div class="flex items-baseline">

                                    <a href="{{ route('home') }}"
                                        class="mt-1 block {{ request()->is('*home*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Dashboard</a>
                                    <a href="{{ route('report.reports.home') }}"
                                        class="mt-1 block {{ request()->is('*reports*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Reports</a>

                                    @if (Auth::user()->isAbleTo('department-list'))
                                        <a href="{{ route('department.departments.index') }}"
                                            class="mt-1 block {{ request()->is('*departments*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Department</a>
                                    @endif
                                    @if (Auth::user()->isAbleTo('course-list'))
                                        <a href="{{ route('course.courses.index') }}"
                                            class="mt-1 block {{ request()->is('*courses*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Programme</a>
                                    @endif
                                    @if (Auth::user()->isAbleTo('lecture-list'))
                                        <a href="{{ route('department.lectures.index') }}"
                                            class="mt-1 block {{ request()->is('*lectures*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Lecture</a>
                                    @endif
                                    @if (Auth::user()->isAbleTo('student-list'))
                                        <a href="{{ route('department.students.index') }}"
                                            class="mt-1 block {{ request()->is('*students*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Student</a>
                                    @endif

                                    @if (Auth::user()->isAbleTo('year-list'))
                                        <a href="{{ route('department.years.index') }}"
                                            class="mt-1 block {{ request()->is('*years*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Accademic
                                            Year</a>
                                    @endif
                                    @if (Auth::user()->isAbleTo('faculty-list'))
                                        <a href="{{ route('facultys.index') }}"
                                            class="mt-1 block {{ request()->is('*facultys*') ? 'nav-button-active btn btn-success' : 'nav-button' }}">Faculty
                                            </a>
                                    @endif

                                </div>
                            </div>
                            <div class="ml-10 flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Menus
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                        @if (Auth::user()->isAbleTo('module-list'))
                                            <li>
                                                <a href="{{ route('course.modules.index') }}"
                                                    class="ml-4 {{ request()->is('*modules*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Course
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->isAbleTo('comment-list'))
                                            <li>
                                                <a href="{{ route('comment.comments.index') }}"
                                                    class="ml-4 {{ request()->is('*comments*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Comment
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->isAbleTo('question-list'))
                                            <li>
                                                <a href="{{ route('comment.questions.index') }}"
                                                    class="ml-4 {{ request()->is('*question*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Question
                                                </a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->isAbleTo('answer-list'))
                                            <li>
                                                <a href="{{ route('comment.answers.index') }}"
                                                    class="ml-4 {{ request()->is('*answers*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Answer
                                                </a>
                                            </li>
                                        @endif




                                    </ul>
                                </div>
                            </div>
                            @if (Auth::user()->isAn('administrator'))
                                <div class="ml-10 flex-shrink-0">
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Role Management
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <a href="{{ route('laratrust.permissions.index') }}"
                                                    class="ml-4 {{ request()->is('*permissions*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Permissions
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('laratrust.roles.index') }}"
                                                    class="ml-4 {{ request()->is('*roles') ? 'nav-button-active' : 'nav-button' }}">
                                                    Roles
                                                </a>
                                            </li>
                                            <li> <a href="{{ route('laratrust.roles-assignment.index') }}"
                                                    class="ml-4 {{ request()->is('*roles-assigment*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Roles & Permissions
                                                </a></li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li> <a href="{{ route('user.users.index') }}"
                                                    class="ml-4 {{ request()->is('*users*') ? 'nav-button-active' : 'nav-button' }}">
                                                    Manage User
                                                </a></li>

                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="ml-10 flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Account
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="ml-4">
                                                {{ Auth::user()->name }}
                                            </a>
                                        </li>

                                        <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <div>
                                                <div class="d-grid gap-2 d-md-block">
                                                    <a class="ml-4 btn btn-danger" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    @endguest
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!--
      Mobile menu, toggle classes based on menu state.

      Open: "block", closed: "hidden"
    -->
            <div class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 sm:px-3">
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</a>
                    <a href="#"
                        class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Team</a>
                    <a href="#"
                        class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Projects</a>
                    <a href="#"
                        class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Calendar</a>

                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="containter">
                <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">
                        @yield('title')
                    </h1>
                </div>
            </div>
        </header>
        <main>
            <div class="max-w-6xl mx-auto py-6 sm:px-6 lg:px-8">
                @foreach (['error', 'warning', 'success'] as $msg)
                    @if (Session::has('laratrust-' . $msg))
                        <div class="alert-{{ $msg }}" role="alert">
                            <p>{{ Session::get('laratrust-' . $msg) }}</p>
                        </div>
                    @endif
                @endforeach
                <div class="px-4 py-6 sm:px-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>

</html>
