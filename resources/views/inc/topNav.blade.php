<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid welcome">

                    <button type="button" id="sidebarCollapse" class="btn toggle" style="box-shadow:none;">
                        <i class="fas fa-align-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>

                    <div class="my-row h-100">
                        <div class="col-md-12">
                            @php
                                $first = Auth::user()->name;
                                $first = explode(' ',trim($first));
                                $first = $first[0];
                            @endphp
                            <center>
                                <p class="my-auto">Welcome back, <b>{{ $first }}</b> </p>
                            </center>
                        </div>
                    </div>
                   
                </div>
            </nav>
            <p style="font-size:13px; text-align:right;"><strong style="font-weight:700;">Last Login: &nbsp;</strong>{{Auth::user()->last_login}}</p>