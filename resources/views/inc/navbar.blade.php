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
                    <a href="./dashboard">
                        <i class="fas fa-home text-warning"></i>
                        Home
                    </a>
                </li>
                <li >
                    <a href="./energy">
                        <i class="fas fa-lightbulb text-warning"></i>
                        Energy Usage
                    </a>
                </li>
                <li>
                    <a href="./paymentHistory">
                        <i class="fas fa-history text-warning"></i>
                        Payment History
                    </a>
                </li>
                <li>
                    <a href="./topup">
                        <i class="fas fa-money-bill-alt text-warning"></i>
                        Top Up
                    </a>
                </li>

                <li>
                    <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cogs text-warning"></i>
                        Settings
                    </a>
                    <ul class="collapse list-unstyled" id="settingsSubmenu">
                        <li>
                            <a href="./account"><i class="fas fa-user text-warning"></i> My Account</a>


                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();
                                                     ">
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

