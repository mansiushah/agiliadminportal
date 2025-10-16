<div class="right_section_header">
    <div class="right_header_lft">
        <a href="#" class="menu_toggle">
            <img src="{{ url('public/assets/img/toggle-menu.svg') }}" alt="toggle-menu" class="img-fluid ">
        </a>

        <a href="#" class="menu_toggle_mobile" id="mobile_menu_toggle">
            <img src="{{ url('public/assets/img/toggle-menu.svg') }}" alt="toggle-menu" class="img-fluid ">
        </a>

    </div>
    <div class="right_header_rht ">
        @if (!request()->routeIs('changepassword') && !request()->routeIs('orgrequest') && !request()->routeIs('categories') && !request()->routeIs('category.add'))
        <div class="right_header_switch mr-3">
        <div class="right_header_switch_lft">
            <label id="modeLabel">
                {{ auth()->user()->environment == 1 ? 'LIVE MODE' : 'TEST MODE' }}
            </label>
        </div>
        <div class="right_header_switch_rht">
            <input type="checkbox"
                   hidden="hidden"
                   id="modeToggle"
                   {{ auth()->user()->environment == 1 ? 'checked' : '' }}>
            <label class="switch" for="modeToggle"></label>
        </div>
        </div>
        @endif
        <div class="right_header_profile">
            <div class="right_header_profil_ttl">
                <p>Admnin User</p>
            </div>
            <div class="dropdown">
                <button class="btn dropdown-toggle border-0 pr-0" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url('public/assets/img/profilePicture.svg') }}" alt="profilePicture" class="img-fluid">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="{{route('changepassword')}}">
                            <img src="{{ url('public/assets/img/lock.svg') }}" alt="lock" class="img-fluid pr-2">
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('logout')}}">
                            <img src="{{ url('public/assets/img/logout.svg') }}" alt="lock" class="img-fluid pr-2">
                            <span class="logout">Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="SwitchOrganaizationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SwitchOrganaizationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content add_user_modal_content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="SwitchOrganaizationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4 text-center">
                <p class="mb-3">Do you wish to leave this screen?</p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-secondary Cancle_outline_btn" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary Confirm_Delete_Btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>