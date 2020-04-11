{{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm navbar-inverse navbar-static-top my-nav">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}


        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <a href="/dashboard">
                    <h3><center><img src="{{asset('/img/PNG3.png')}}" alt="" style="width:70%;"></center></h3>
                    <strong style="font-weight:700;">NRG BEE</strong>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li >
                    <a href="./customers">
                        <i class="fas fa-user text-warning"></i>
                        Customers
                    </a>
                </li>
                <li >
                    <a href="./alarms">
                        <i class="fas fa-user-clock text-warning"></i>
                        Alarms
                    </a>
                </li>
                <li >
                    <a href="./daily_readings">
                        <i class="fas fa-history text-warning"></i>
                        Daily Reading
                    </a>
                </li>
                <li>
                    <a href="./monthly_readings">
                        <i class="fas fa-history text-warning"></i>
                        Monthly Reading
                    </a>
                </li>
                <li>
                    <a href="./payment_history">
                        <i class="fas fa-money-bill-alt text-warning"></i>
                        Payment History
                    </a>
                </li>
                <li>
                    <a href="./payment_transactions">
                        <i class="fas fa-money-bill-alt text-warning"></i>
                        Payment Transactions
                    </a>
                </li>
                
                <li>
                    <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cogs text-warning"></i>
                        Settings
                    </a>
                    <ul class="collapse list-unstyled" id="settingsSubmenu">
                        <li>
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-sign-out-alt text-warning"></i>
                                        {{ __('Logout') }}
                                        
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>                     
                    </ul>
                </li>
            </ul>

        </nav>
   



{{-- 
<div class="jumbotron welcome">
   <div class="my-row h-100">
        <div class="col-md-12 my-auto">
            <center>
                <p>Welcome back, <b>{{ Auth::user()->name }}</b> </p>
            </center>
        </div>
   </div>
</div> --}}

