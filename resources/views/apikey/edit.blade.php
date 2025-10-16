@extends('layouts.master')
@section('title', 'Edit User')
@section('content')
<div class="right_bottom_ttl mb-4">
<div class="right_bottom_ttl_lft d-flex ">
    <a href="{{ route('users')}}" class="user_back_btn"><img src="{{url('public/assets/img/back-arrow.svg')}}" alt="back-arrow"
            class="img-fluid"></a>
    <h4 class="ml-3 mb-0">Edit User</h4>
</div>
<div class="right_bottom_ttl_rht"></div>
</div>

<div class="manage_user_main_card">
<div class="manage_user_card_ttl">
    <h5>Edit User</h5>
    <p>Edit user details</p>
</div>

<div class="add_user_form mt-3">
    <form method="POST" action="{{ route('user.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-row">
            <div class="form-group col-md-12 verification-radio add_verification-radio mb-2">
                <div class="form-check form-check-inline pl-0 mb-0">
                    <label class="role_label">Status*</label>
                    <div class="radio ml-0">
                        <input id="radio-9" name="enabled" type="radio" value="1" {{ $data->enabled == 1 ? 'checked' : '' }}>                        <label for="radio-9" class="radio-label">Enable</label>
                    </div>

                </div>
                <div class="form-check form-check-inline pl-0">
                    <div class="radio ml-0">
                        <input id="radio-10" name="enabled" value="0" type="radio" {{ $data->enabled == 0 ? 'checked' : '' }}>
                        <label for="radio-10" class="radio-label">Disable</label>
                    </div>
                </div>
                @error('enabled')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 verification-radio add_verification-radio mb-2">
                <div class="form-check form-check-inline pl-0 mb-0">
                    <label class="role_label">Role*</label>
                    <div class="radio ml-0">
                        <input id="radio-5" name="role_id" type="radio" value="1" {{ $data->role_id == 1 ? 'checked' : '' }}>
                        <label for="radio-5" class="radio-label">Org Admin</label>
                    </div>

                </div>
                <div class="form-check form-check-inline pl-0">
                    <div class="radio ml-0">
                        <input id="radio-6" name="role_id" value="2" type="radio"{{ $data->role_id == 2 ? 'checked' : '' }}>
                        <label for="radio-6" class="radio-label">Advertiser</label>
                    </div>
                </div>

                <div class="form-check form-check-inline pl-0">
                    <div class="radio ml-0">
                        <input id="radio-7" name="role_id" type="radio" value="3" {{ $data->role_id == 3 ? 'checked' : '' }}>
                        <label for="radio-7" class="radio-label">Developer</label>
                    </div>
                </div>
                @error('role_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12 mb-3">
                <label>Full Name *</label>
                <input type="text" class="form-control" placeholder="Enter full name" name="full_name" value="{{ $data->full_name }}">
                @error('full_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12 mb-3">
                <label>Email *</label>
                <input type="mail" class="form-control" placeholder="Enter email address" name="email" value="{{ $data->email }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>


        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12 mb-3">
                <label>Phone Number *</label>
                <input type="number" class="form-control" placeholder="+1 1234567890" name="phone_number" value="{{ $data->phone_number }}">
                @error('phone_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>
        </div>

        <div class="form-row mt-2 admin_add_user_btns">
           <!--  <button type="button" class="btn btn-primary Create_Btn mr-2 mb-3"
                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create
            </button> -->
               <button type="submit" class="btn btn-primary Create_Btn mr-2 mb-3">Update</button>
            <button type="submit"
                class="btn btn-primary Cancle_outline_btn mb-3">Cancel</button>
        </div>
    </form>
</div>
</div>

@endsection
