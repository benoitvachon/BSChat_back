<!DOCTYPE html>
<html ng-app='studycom' lang="{{ config('app.locale')}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Studycom</title>

        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ URL::asset('css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href='{{ URL::asset('css/layout.css') }}' rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/global.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.min.js"></script>

        <script type="text/javascript" src="{{ URL::asset('js/studycom-module.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/controller/topicController.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/controller/sidenavController.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/controller/profileController.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/controller/contactController.js') }}"></script>
    </head>
    <body>
        <header class="page-header">
            <div class='navbar-fixed'>
                <nav>
                    <div class="nav-wrapper">
                        <h1 class="nav-title"><a href='{{ url('/home')}}'>Studycom</a></h1>
                        @yield('floatingButton')
                        <ul id="nav-mobile" class="right">
                            @if (Auth::guest())
                            <li><a href="{{ url('/register')}}">Inscription</a></li>
                            <li><a href="{{ url('/login')}}">Connexion</a></li>
                            @else
                            
                            <li class="dropdown">
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/profil">
                                            Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout')}}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>


                                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                                            {{ csrf_field()}}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                            @endif
                        </ul>
                        <a class="dropdown-button waves-effect right" href="#!" data-activates="dropdown-connected-user">
                            <i class="mdi-navigation-arrow-drop-down material-icons right">person_pin</i>
                        </a>
                    </div>
                </nav>
            </div>
        </header>

        @yield('sidenav')

        @yield('welcome')

        <div class="container feed">
            @yield('content')
        </div>

    </body>
</html>
