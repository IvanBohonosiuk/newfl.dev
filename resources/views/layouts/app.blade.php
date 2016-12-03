<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('styles')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="{{ url('/') }}" class="brand-logo center">
                    {{ config('app.name', 'Laravel NewFL') }}
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    @if(Auth::user())
                        <ul id="slide-out" class="side-nav">


                            @foreach (Auth::user()->unreadNotifications as $notification)
                                <li>
                                    <a href="{{ route('projects.show', $notification->data['project']['id']) }}">
                                        <i class="material-icons {{ $notification->data['color_icon'] }}">{{ $notification->data['icon'] }}</i>
                                        <span>{{  $notification->data['project']['title'] }}</span> <img class="responsive-img circle" style="width: 25px; position: relative; top: 10px;" src="/uploads/avatars/{{ $notification->data['author']['image'] }}"> <small>{{ $notification->data['author']['name'] }}</small>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <li>
                            <a class="button-notifications item notification-item" data-activates="slide-out" @click="showNotifications">
                                <i class="material-icons">today</i>
                                <span class="badge notify red white-text circle" v-if="hasUnreadNotifications">@{{ countUnreadNotifications }}</span>
                            </a>
                            {{--<a href="#" data-activates="slide-out" class="button-notifications">--}}
                                {{--<i class="material-icons">today</i>--}}
                                {{--@if(Auth::user()->unreadNotifications())--}}
                                    {{--<span class="badge notify red white-text circle">{{ count(Auth::user()->unreadNotifications()) }}</span>--}}
                                {{--@endif--}}
                            {{--</a>--}}
                        </li>
                    @endif
                    {{--<!-- Dropdown Trigger -->--}}
                    <li>
                        <a class='dropdown-button btn-floating btn waves-effect blue' href='#' data-activates='dropdown2'>
                            @if(session('locale'))
                                {{ session('locale') }}
                            @else
                                {{ Config::get('app.locale') }}
                            @endif
                        </a>
                    </li>

                    <!-- Dropdown Structure -->
                    <ul id='dropdown2' class='dropdown-content'>
                        @foreach(\Backpack\LangFileManager\app\Models\Language::getActiveLanguages() as $lang)
                            <li class="{{ session('locale') == $lang->abbr ? 'active' : '' }}">
                                <a href="/language?lang={{ $lang->abbr }}" >{{ $lang->abbr }}</a>
                            </li>
                        @endforeach
                    </ul>

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li>
                            <a class="dropdown-button" href="#" data-activates="dropdown1">
                                {{--<img src="https://placeholdit.imgix.net/~text?txtsize=100&w=160&h=160&bg=00a65a&txtclr=ffffff&txtalign=middle,center&txt={{ Auth::user()->name[0] }}" class="responsive-img circle" alt="User Image" style="width: 35px; position: relative; top: 12px;">--}}
                                <img src="/uploads/avatars/{{ Auth::user()->image }}" class="responsive-img circle" style="width: 35px; position: relative; top: 12px;">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                        <!-- Dropdown Structure -->
                        <ul id="dropdown1" class="dropdown-content">

                            @role('admin')
                                <li>
                                    <a href="{{ url('/admin') }}">
                                        Admin
                                    </a>
                                </li>
                                <li class="divider"></li>
                            @endrole
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.show', Auth::user()->id) }}">
                                    Profile
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    @endif

                </ul>
                <ul class="left hide-on-med-and-down">
                    <li class="navitem {{ (route('home') == Request::url())?' active':'' }}">
                        <a href="{{ route('home') }}">@lang('app.menu_home')</a>
                    </li>
                    <li class="navitem {{ (route('projects') == Request::url())?' active':'' }}">
                        <a href="{{ route('projects') }}">@lang('app.menu_projects')</a>
                    </li>
                    <li class="navitem {{ (route('user.freelancers') == Request::url())?' active':'' }}">
                        <a href="{{ route('user.freelancers') }}">@lang('app.menu_freelancers')</a>
                    </li>
                    <li class="navitem">
                        <a href="#">@lang('app.menu_shop')</a>
                    </li>
                    @if(Auth::user())
                        @if(Auth::user()->hasRole('Freelancer'))
                            <li class="navitem ">
                                <a href="#">@lang('app.menu_chat')</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer>

    </footer>
</div>

<!-- Scripts -->
{{--<script src="/js/app.js"></script>--}}
<script type="text/javascript">
    var user = {!! Auth::user() !!}
</script>
<script src="{{ elixir('js/app.js') }}"></script>

{{--<script type="text/javascript">--}}
    {{--jQuery(document).ready(function($) {--}}
        {{--$(".button-notifications").sideNav({--}}
            {{--edge: 'right'--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}

@yield('scripts')
</body>
</html>