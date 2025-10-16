@extends('layouts.master')
@section('title', 'Organisations')
<style>
div#OrganisationsUserTable_length,
    div#OrganisationsUserTable_filter {
        display: none;
}
</style>
@section('content')
<div class="right_bottom_ttl user_right_bottom_ttl">
<div class="right_bottom_ttl_rht">
    <div class="d-flex">
        <a href="{{ route('organisations') }}" class="user_back_btn"><img src="{{ url('public/assets/img/back-arrow.svg') }} " alt="back-arrow"
                class="img-fluid"></a>
        <h4 class="ml-3 mb-0">{{ $Organisationdata->company_name }}</h4>
    </div>
    <ul class="Users_Main_list pl-0 mt-3">
        <li>
            <span class="list_primary_span">Category:</span>
            <span class="list_secondry_span">{{ implode(', ', $Organisationdata->category_names) }}</span>
        </li>
        <li>
            <span class="list_primary_span">Offer Quota:</span>
            <span class="list_secondry_span">{{ $Organisationdata->offer_quota_set == 0 ? 'Unlimited' : $Organisationdata->offer_quota }}</span>
        </li>
        <li>
            <span class="list_primary_span">Ad Unit balance:</span>
            <span class="list_secondry_span">{{ $Organisationdata->wallet_value }}</span>
        </li>
    </ul>
</div>
<div class="right_bottom_ttl_lft">
    <a href="{{ route('organisations.user.disable.all',['id'=>$Organisationdata->id])}}" class="user_disabled_icon mr-2 mb-3">
        <i class="fa fa-ban pr-2" aria-hidden="true"></i>
        <span>Disable All Users</span>
    </a>
    <a href="{{route('organisations.edit', $Organisationdata->id)}}" class="user_edit_icon mr-2 mb-3">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        <span>Edit</span>
    </a>
    <a href="#" class="user_delete_icon mb-3 table_delete_btn" data-bs-toggle="modal"data-bs-target="#DeleteOrganaizationModal" data-id="{{ $Organisationdata->id }}">
        <i class="fa fa-trash mr-1" aria-hidden="true"></i>
        <span>Delete</span>
    </a>
</div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main">
        <div class="manage_user_main_card_lft">
            <h3>Users</h3>
        </div>
        <div class="manage_user_main_card_rht user_mian_rights">
            <div class="user_select_drpdwn">
               <select class="form-select" aria-label="Default select example" name="role_id" id="filterRole">
                    <option value="">Select Role</option>
                    @foreach ($role as $key => $value)
                      <option value="{{ $value->id }}" {{ old('country_id') == $value->id ? 'selected' : '' }}>{{ $value->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('organisations.user.add',['id'=>$Organisationdata->id])}}" class="add_user_btn">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                <span>Add User</span>
            </a>
        </div>
    </div>
    <table id="OrganisationsUserTable" class="display table-responsive-xl wrap user_table w-100">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Role</th>
            <th>Offer quota</th>
            <th>Ad Unit balance</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
</div>
<!-- Delete All -->
<div class="modal fade add_user_moidal" id="DeleteOrganaizationModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content add_user_modal_content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4">
                <div class="add_user_success_card text-center">
                    <h4>Delete Organisation</h4>
                    <p class="mb-2">Are you sure you want to delete this Organisation?</p>
                    <p class="mb-3">This will delete all of their Users, Offers, API keys, and files.</p>
                    <div class="Organaization_delete_Modal_Btm d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary Cancle_outline_btn mb-3 mr-3">Cancel</button>
                        <form action="{{ route('organisations.destroy', $Organisationdata->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm Confirm_Delete_Btn">Confirm Delete</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete single -->
<div class="modal fade add_user_moidal" id="DeleteOrganaizationModal2" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content add_user_modal_content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4">
                <div class="add_user_success_card text-center">
                    <h4>Delete Organisation</h4>
                    <p class="mb-2">Are you sure you want to delete this Organisation?</p>
                    <p class="mb-3">This will delete all of their Users, Offers, API keys, and files.</p>
                    <div class="Organaization_delete_Modal_Btm d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary Cancle_outline_btn mb-3 mr-3">Cancel</button>
                        <form action="#" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm Confirm_Delete_Btn">Confirm Delete</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add_user_moidal" id="EditOrganaizationModal" data-bs-backdrop="static"data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content add_user_modal_content">
        <div class="modal-header border-bottom-0">
            <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body pb-4">
            <div class="add_user_success_card text-center">
                <h4>Password Reset</h4>
                <p class="mb-2">Are you sure you want to reset this user's password?</p>
                <p class="mb-3">A password reset link will be sent to the user via email.</p>
                <div class="Organaization_delete_Modal_Btm d-flex justify-content-center">
                    <button type="submit"
                        class="btn btn-primary Cancle_outline_btn mb-3 mr-3">Cancel</button>
                            <button type="submit" class="btn btn-primary Create_Btn Send_Btn ml-3 mb-3" id="resetpassordUser">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
    let table = $('#OrganisationsUserTable').DataTable({
        processing: true,
        serverSide: true,

        language: {
            emptyTable: 'There are no user accounts having your selected role. Click on the "Add User" button to create a user.',
            paginate: {
                next: '<i class="fa fa-angle-right">',
                previous: '<i class="fa fa-angle-left">'
            }
        },
        ajax: {
            url: "{{ route('organisations.view', $Organisationdata->id) }}",
            data: function (d) {
                d.role_id = $('#filterRole').val(); // Send selected role
                d.status = $('#filterStatus').val(); // If you have status filter
            }
        },
        columns: [
            {data: 'name', name: 'name'},            // first_name + last_name
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'role', name: 'role'},            // role name
            {data: 'offer_quota', name: 'wallet_value'},            // role name
            {data: 'wallet_value', name: 'wallet_value'},            // role name
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    // 🔄 Reload table on filter change
    $('#filterRole, #filterStatus').on('change', function () {
        table.ajax.reload();
    });
});
//model code
/*$(document).on('click', '.openDeleteModal', function () {
    let id = $(this).data('id');
    let url = "{{ route('organisations.user.destroy', ':id') }}";
    url = url.replace(':id', id);
    $('#DeleteOrganaizationModal2 form').attr('action', url);
});*/
$(document).on('click', '.openResetModal', function () {
    let userId = $(this).data('id');
    $('#resetpassordUser').data('id', userId);  // store user id in button
});
$(document).on('click', '#resetpassordUser', function () {
    let userId = $(this).data('id');
    let url = "{{ route('organisations.reset.user.password', ':id') }}";
    url = url.replace(':id', userId);
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
        },
        success: function (response) {
            // Close modal
            $('#EditOrganaizationModal').modal('hide');
            // Wait until modal is hidden, then reload page
            $('#EditOrganaizationModal').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function (xhr) {
            alert('Something went wrong.');
        }
    });
});
</script>
<!-- <script src="{{ url('public/assets/js/custom/organisationview.js') }}"></script> -->
@endpush
