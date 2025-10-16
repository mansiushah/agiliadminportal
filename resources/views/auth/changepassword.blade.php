@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('content')
<div class="right_bottom_ttl mb-4">
  <div class="right_bottom_ttl_lft">
    <h4>Change Password</h4>
    <p>Update your account password</p>
  </div>
  <div class="right_bottom_ttl_rht"></div>
</div>

<div class="manage_user_main_card">
  <div class="manage_user_card_ttl">
    <h5>Update Password</h5>
    <p>Enter your current password and choose a new secure password </p>
  </div>
  @include('flash-message')
  <div class="add_user_form mt-3">
    <form method="POST" action="{{ route('update.changepassword') }}">
      @csrf
      <div class="form-row add_user_form_row">
        <div class="form-group col-md-12 mb-3">
          <label>Current Password</label>
          <input type="password" class="form-control"
                 placeholder="Enter current password" name="old_password">
          <a href="#" toggle="#password-field"
             class="fa fa-fw fa-eye field-icon toggle-password change_password_toggle"></a>
          @error('old_password')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-row add_user_form_row">
        <div class="form-group col-md-12 mb-3">
          <label>New Password</label>
          <input type="password" class="form-control" placeholder="Enter new password" name="new_password">
          <a href="#" toggle="#password-field"
             class="fa fa-fw fa-eye field-icon toggle-password change_password_toggle"></a>
          @error('new_password')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>


      <div class="form-row add_user_form_row">
        <div class="form-group col-md-12 mb-3">
          <label>Confirm New Password</label>
          <input type="password" class="form-control" placeholder="Confirm new password" name="confirm_password">
          <a href="#" toggle="#password-field"
             class="fa fa-fw fa-eye field-icon toggle-password change_password_toggle"></a>
          @error('confirm_password')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>


      <div class="form-row mt-2 admin_add_user_btns">
        <button type="submit"
                class="btn btn-primary Create_Btn Update_Password_Btn mr-2 mb-3">
          Update Password
        </button>

      </div>
    </form>
  </div>
</div>
@endsection
