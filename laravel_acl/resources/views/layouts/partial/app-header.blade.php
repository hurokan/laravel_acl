<!--Header Area Start-->
<header class="header-area light">
    <div class="container-fluid c-fulid-max">
        <div class="row align-items-center">
            <div class="col-4 col-md-2">
                <div class="logo-wrapper">
                    <a href="/">
                        <img class="logo-sheltech" src="{{asset('assets/app/img/logo.png')}}" alt="">
                        <img class="logo-sheltech-light" src="{{asset('assets/app/img/Orginal.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-8 col-md-10">
                <div class="menu-wrapper">
                    <nav class="main-nav">
                        <!-- Mobile menu toggle button (hamburger/x icon) -->
                        <input id="main-menu-state" type="checkbox"/>
                        <label class="main-menu-btn" for="main-menu-state">
                            <span class="main-menu-btn-icon"></span>
                        </label>

                        <!-- Sample menu definition -->
                        <ul id="main-menu" class="sm sm-mint">
                            <li><a href="/#/about">About Us</a></li>
                            <li><a href="/#/properties">Listed Properties</a>
                                <ul>
                                    <li><a href="/#/exclusive-sheltech">Sheltech Exclusives</a></li>
                                    <li><a href="/#/properties">All Properties</a></li>
                                </ul>
                            </li>
                            <li><a href="/#/contact">Contact</a></li>
                        </ul>

                        <div class="menu-2">
                            <ul id="main-menu" class="sm sm-mint">
                                <li><a href="#"><i class="flaticon-translate"></i> En<i
                                            class="flaticon-drop-down-arrow dwon-arrow"></i></a></li>
                                <li><a href="#" class="col-ver"><i class="flaticon-moon"></i></a>

                                    <div class="color-version viewCard">
                                        <span>Dark</span>
                                        <span class="span2">Light</span>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active dark-switch" data-id="1" id="nav-profile-tab"
                                                data-toggle="tab" href="#" role="tab" aria-controls="month-price"
                                                aria-selected="false"> <i class="flaticon-moon"></i> </a>
                                            <a class="nav-item nav-link light-switch" id="nav-home-tab" data-id="2" data-toggle="tab" href="#"
                                               role="tab"
                                               aria-controls="yearly-price" aria-selected="true"> <i
                                                    class="flaticon-moon"></i></a>
                                        </div>
                                    </div>

                                </li>
                                @guest
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Favorite <i class="flaticon-like"></i></a></li>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Sign In <i class="flaticon-drop-down-arrow dwon-arrow"></i> <i
                                            class="flaticon-user-1"></i></a></li>
                                @else
                                    <li><a href="/#/favourite-property">Favorite <i class="flaticon-like"></i></a></li>
                                    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out <i class="flaticon-drop-down-arrow dwon-arrow"></i> <i
                                                class="flaticon-user-1"></i></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>

                </div>

            </div>

        </div>

    </div>

</header>

<!--Header Area End-->
