@extends('layouts.master')
@section('title', 'Promo codes Add')
@section('content')
<div class="right_bottom_ttl mb-4">
<div class="right_bottom_ttl_lft">
    <h4>Promo codes</h4>
    <p>Manage Promo codes and their order</p>
</div>
<div class="right_bottom_ttl_rht"></div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_card_ttl">
        <h5>Promo codes List</h5>
    </div>
    <div class="add_user_form mt-3">
        <form method="POST" action="{{ route('promocode.store') }}">
           @csrf
            <div class="form-row add_user_form_row">
                <div class="form-group col-md-12 mb-3">
                  <label for="uname">Promo Code* (Allowed: A–Z, 0–9 | Max 50 characters | Not case sensitive)</label>
                  <input type="text" id="uname" name="promo_code"
                    class="form-control" minlength="2" value="{{ old('promo_code') }}"
                  />
                    @error('promo_code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row add_user_form_row">
                <div class="form-group col-md-12 mb-3">
                  <label for="uname">Percentage*</label>
                  <input type="text" id="uname" name="percentage"
                    class="form-control" minlength="2" value="{{ old('percentage') }}" data-error=".errorTxt1"
                  />
                  @error('percentage')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row add_user_form_row">
                <div class="form-group col-md-12">
                    <label>Select Organisation  (optional)</label>
                    <select name="organisation_id" class="form-select" aria-label="Default select example">
                    <option value="">Select Organisation</option>
                    @foreach ($organisation as $key => $value)
                    <option value="{{ $value->id }}" {{ old('organisation_id') == $value->id ? 'selected' : '' }}>{{ $value->company_name }}</option>
                    @endforeach
                    </select>
                    @error('organisation_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        <div class="form-row">
            <div class="form-group col-md-12 verification-radio add_verification-radio mb-2">
                <div class="form-check form-check-inline pl-0 mb-0">
                    <label class="role_label">Expiry</label>
                    <div class="radio ml-0">
                        <input id="radio-9" name="enabled" type="radio" value="1">
                        <label for="radio-9" class="radio-label">No expiry</label>
                    </div>
                </div>
                <div class="form-check form-check-inline pl-0">
                    <div class="radio ml-0">
                        <input id="radio-10" name="enabled" value="0" type="radio" checked>
                        <label for="radio-10" class="radio-label">Custom date & time</label>
                    </div>
                </div>
                @error('enabled')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row add_user_form_row expiry_class">
            <div class="form-group col-md-4 add_user_phone">
                <label>Expiry Date</label>
                <input type="date" class="form-control" placeholder="17 / 06 / 2025" name="end_date">
            </div>
            <div class="form-group col-md-4 add_user_phone">
                <label>Expiry Time</label>
                <input type="time" class="form-control" placeholder="11:59 PM" name="end_time">
            </div>
            <div class="form-group col-md-4 add_user_phone">
                <label>Time Zone</label>
                <select name="time_zone_name" class="form-select" aria-label="Default select example">
                   <option value="">Select</option>
                    @foreach ($timezone as $key => $value)
                    <option value="{{ $value->Name }}">{{ $value->Name }}</option>
                    @endforeach
                </select>
                @error('time_zone_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row mt-2 admin_add_user_btns">
              <button type="submit" class="btn btn-primary Create_Btn mr-2 mb-3">Create</button>
              <a href="{{ url('categories') }}"
                  class="btn btn-primary Cancle_outline_btn mb-3">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    function toggleExpiryFields() {
        if ($("input[name='enabled']:checked").val() == "1") {
            $(".expiry_class").hide(); // hide expiry fields
        } else {
            $(".expiry_class").show(); // show expiry fields
        }
    }
    // On page load
    toggleExpiryFields();
    // On change
    $("input[name='enabled']").change(function () {
        toggleExpiryFields();
    });
});
</script>
@endpush
