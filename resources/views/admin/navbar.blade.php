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
                            <a href="./account"><i class="fas fa-user text-warning"></i> My Account</a>

                        </li>
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

