<div class="left_menu">
                <div class="left_menu_logo mb-3">
                    <img src="{{ url('public/assets/img/logo-sml.png') }}" alt="logo-sml" class="img-fluid">
                    <img src="{{ url('public/assets/img/logo-text.png') }}" alt="logo-text" class="img-fluid ml-2 text_logo">
                </div>
                <div class="sidebar_menu ">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('dashboard')}}">
                                <img src="{{ url('public/assets/img/dashboard.svg') }}" alt="dashboard-icon" class="img-fluid">
                                <span class="dashboard-list-txt">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('organisations') ? 'active' : '' }}" href="{{ url('organisations') }}">
                                <img src="{{ url('public/assets/img/manage-user.svg') }}" alt="manage-user" class="img-fluid">
                                <span class="dashboard-list-txt">Organisations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('offer') ? 'active' : '' }}" href="{{ url('offer') }}">
                                <img src="{{ url('public/assets/img/manage-offer.svg') }}" alt="manage-offer" class="img-fluid">
                                <span class="dashboard-list-txt">Offers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('analytics') ? 'active' : '' }}" href="{{ url('analytics') }}">
                                <img src="{{ url('public/assets/img/analytics.svg') }}" alt="analytics" class="img-fluid">
                                <span class="dashboard-list-txt">Analytics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('categories') ? 'active' : '' }}" href="{{ url('categories')}}">
                                <img src="{{ url('public/assets/img/categories.svg') }}" alt="categories" class="img-fluid">
                                <span class="dashboard-list-txt">Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link {{ Route::is('api-keys') ? 'active' : '' }}" href="{{ url('api-keys') }}">
                                <img src="{{ url('public/assets/img/manage-api-keys.svg') }}" alt="manage-api-keys" class="img-fluid">
                                <span class="dashboard-list-txt">API Keys</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('orgrequest') ? 'active' : '' }}" href="{{ url('org-request')}}">
                                <img src="{{ url('public/assets/img/Org-Requests.svg') }}" alt="Org-Requests" class="img-fluid">
                                <span class="dashboard-list-txt">Org. Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('invoices') ? 'active' : '' }}" href="{{ url('invoice') }}">
                                <img src="{{ url('public/assets/img/invoice.svg') }}" alt="invoice" class="img-fluid">
                                <span class="dashboard-list-txt">Invoices</span>
                            </a>
                        </li>
                      <li class="nav-item">
                            <a class="nav-link {{ Route::is('promocode') ? 'active' : '' }}" href="{{url('promocode')}}">
                                <img src="{{ url('public/assets/img/Promocode.svg') }}" alt="Promocode" class="img-fluid">
                                <span class="dashboard-list-txt">Promo code</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mobile_left_menu">
                <div class="left_menu_logo mb-3 position-relative">
                    <a href="#" class="mobile_menu_close"><i class="fa fa-times"></i></a>
                    <img src="{{ url('public/assets/img/logo-sml.png') }}" alt="logo-sml" class="img-fluid">
                    <img src="{{ url('public/assets/img/logo-text.png') }}" alt="logo-text" class="img-fluid ml-2 text_logo">
                </div>
                <div class="mobile_sidebar_menu ">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('dashboard') }}">
                                <img src="{{ url('public/assets/img/dashboard.svg') }}" alt="dashboard-icon" class="img-fluid">
                                <span class="dashboard-list-txt">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('organisations') ? 'active' : '' }}" href="{{ url('organisations') }}">
                                <img src="{{ url('public/assets/img/manage-user.svg') }}" alt="manage-user" class="img-fluid">
                                <span class="dashboard-list-txt">Organisations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('offer') ? 'active' : '' }}" href="{{ url('offer') }}">
                                <img src="{{ url('public/assets/img/manage-offer.svg') }}" alt="manage-offer" class="img-fluid">
                                <span class="dashboard-list-txt">Offers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{ Route::is('analytics') ? 'active' : '' }}" href="{{ url('analytics') }}">
                                <img src="{{ url('public/assets/img/analytics.svg') }}" alt="analytics" class="img-fluid">
                                <span class="dashboard-list-txt">Analytics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('categories') ? 'active' : '' }}" href="{{ url('categories')}}">
                                <img src="{{ url('public/assets/img/categories.svg') }}" alt="categories" class="img-fluid">
                                <span class="dashboard-list-txt">Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('api-keys') ? 'active' : '' }}" href="{{ url('api-keys') }}">
                                <img src="{{ url('public/assets/img/manage-api-keys.svg') }}" alt="manage-api-keys" class="img-fluid">
                                <span class="dashboard-list-txt">API Keys</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('orgrequest') ? 'active' : '' }}" href="{{ url('org-request')}}">
                                <img src="{{ url('public/assets/img/Org-Requests.svg') }}" alt="Org-Requests" class="img-fluid">
                                <span class="dashboard-list-txt">Org. Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link { Route::is('invoice') ? 'active' : '' }}" href="{{ url('invoices') }}">
                                <img src="{{ url('public/assets/img/invoice.svg') }}" alt="Invoices" class="img-fluid">
                                <span class="dashboard-list-txt">Invoices</span>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link {{ Route::is('promocode') ? 'active' : '' }}" href="{{url('promocode')}}">
                                <img src="{{ url('public/assets/img/Promocode.svg') }}" alt="Promocode" class="img-fluid">
                                <span class="dashboard-list-txt">Promo code</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
