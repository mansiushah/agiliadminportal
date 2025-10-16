@extends('layouts.master')
@section('title', 'Edit organisation')
@section('content')
<style>
    #vatFieldsContainer {
    display: block; /* or flex/grid if needed */
    height: auto !important;
    overflow: visible;
}
        /* Autocomplete CSS Start */
        #autocomplete {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        #autocomplete:focus {
            outline: none;
        }

        /* Custom dropdown styling */
        .autocomplete-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #2c3e50;
            border: 1px solid #34495e;
            border-radius: 6px;
            margin-top: 2px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .autocomplete-dropdown.show {
            display: block;
        }

        .autocomplete-item {
            background-color: #000000;
            color: #ecf0f1;
            padding: 12px;
            cursor: pointer;
            border-bottom: 1px solid #ffffff;
        }

        .autocomplete-item:last-child {
            border-bottom: none;
        }

        .autocomplete-item:hover {
            background-color: #34495e;
        }

        .autocomplete-item-text {
            font-size: 14px;
        }

        /* Autocomplete CSS End */
</style>

<div class="right_bottom_ttl mb-4">
    <div class="right_bottom_ttl_lft d-flex ">
        <a href="{{route('organisations')}}" class="user_back_btn"><img src="{{url('public/assets/img/back-arrow.svg')}}" alt="back-arrow"
                class="img-fluid"></a>
        <h4 class="ml-3 mb-0">Edit organisation</h4>
    </div>
    <div class="right_bottom_ttl_rht"></div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_card_ttl">
        <h5>Organisation Details</h5>
        <p>Edit organisation to the system</p>
    </div>
<div class="add_user_form mt-3">
<form  method="POST" action="{{ route('organisations.update') }}">
    <input type="hidden" name="id" value="{{ $data->id }}"/>
  @csrf
         <div class="form-row add_user_form_row">
            <div class="form-group col-md-6 mb-3">
                <label>Company name*</label>
                <input type="text" class="form-control" name="company_name" placeholder="Company name" value="{{ $data->company_name }}">
                @error('company_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Company number*</label>
                <input type="text" class="form-control" name="company_number" placeholder="Company number" value="{{ $data->company_number }}">
                @error('company_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Trading name</label>
                <input class="form-control" name="trading_name" type="text" placeholder="Trading name" value="{{ $data->trading_name }}">
            </div>
        </div>
        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Company email</label>
                <input class="form-control" name="company_email" type="text" placeholder="Company email" value="{{ $data->company_email }}">
            </div>
        </div>
        <div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Company address*</label>
                 <input type="text" id="autocomplete" placeholder="Enter address" class="w-100">
                    <div class="autocomplete-dropdown" id="dropdown"></div>
            </div>
          		 @error('company_address_google_placeid')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>
         <input type="hidden" name="company_address_line1" id="line1" placeholder="Address Line 1"   value="{{ $data->company_address_line1 }}">
        <input type="hidden" name="company_address_line2" id="line2" placeholder="Address Line 2 (optional)"  value="{{ $data->company_address_line2 }}">
        <input type="hidden" name="company_address_city" id="city" placeholder="City" value="{{ $data->company_address_city }}">
        <input type="hidden" name="company_address_state" id="state" placeholder="State" value="{{ $data->company_address_state }}">
        <input type="hidden" name="company_address_postal_code" id="postal_code" placeholder="Postal Code" value="{{ $data->company_address_postal_code }}">
        <input type="hidden" name="company_address_country" id="country" placeholder="Country" value="{{ $data->company_address_country }}">
        <input type="hidden" name="company_address_google_placeid" id="place_id" placeholder="Google Place ID" value="{{ $data->company_address_google_placeid }}">
        <div class="form-row add_user_form_row">
            <div class="form-group col-md-6 mb-3">
                <label>Country*</label>
                <select class="form-select" aria-label="Default select example" name="country_id" id="countrySelect" data-tax-url="{{ url('/get-tax-registrations') }}">
                    <option value="">Select Country</option>
                    @foreach ($countries as $key => $value)
                      <option value="{{ $value->id }}"
                    data-code="{{ $value->code }}" {{ $data->country_id == $value->id ? 'selected' : '' }}>{{ $value->country }}</option>
                    @endforeach
                </select>
                @error('country_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6 mb-3" id="usaStateGroup">
                <label>State*</label>
                <select class="form-select" aria-label="Default select example" name="usa_state_id">
                    <option value="">Select Usa state</option>
                      @foreach ($usastates as $key => $value)
                              <option value="{{ $value->usa_state_id }}" {{ $data->usa_state_id == $value->usa_state_id ? 'selected' : '' }}>
                              {{ $value->usa_state_name }}</option>
                      @endforeach
                </select>
                @error('usa_state_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <!--<div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Currency*</label>
                <select name="currency_id" class="form-select" aria-label="Default select example">
                   <option value="">Select Currency</option>
                      @foreach ($currencies as $key => $value)
                              <option value="{{ $value->id }}" {{ $data->currency_id == $value->id ? 'selected' : '' }}>
                              {{ $value->currency }} ({{ $value->symbol }})</option>
                      @endforeach
                </select>
                @error('currency_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div> -->
   		<div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Currency*</label>
                <select name="currency_id" id="currency" class="form-select" aria-label="Default select example">
                    <option value="">Select Currency</option>
                </select>

                @error('currency_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
             <div id="vatFieldsContainer" class="mt-3"></div>
        <div class="form-row add_user_form_row multiselect_category">
            <div class="form-group col-md-12 mb-3">
                <label class="d-block">Category*</label>
               <select class="categories_select" name="category_id[]" multiple="multiple">
                    @foreach ($category as $key => $value)
                        <option value="{{ $value->id }}"
                            {{ is_array($data->category_id) && in_array($value->id, $data->category_id) ? 'selected' : '' }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 verification-radio add_verification-radio mb-2">
                <div class="form-check form-check-inline pl-0 mb-0">
                    <label class="role_label">Maximum Offers</label>
                    <div class="radio ml-0">
                        <input id="radio-5" name="offer_quota" type="radio" class="unlimited_ofr_inpt" value="0" {{ old('offer_quota', $data->offer_quota_set ?? '') == 0 ? 'checked' : '' }}>
                        <label for="radio-5" class="radio-label">Unlimited offers</label>
                    </div>
                </div>
                <div class="form-check form-check-inline pl-0">
                    <div class="radio ml-0">
                        <input id="radio-6" name="offer_quota" type="radio"
                            class="limited_ofr_inpt" value="1" {{ old('offer_quota', $data->offer_quota_set ?? '') == 1 ? 'checked' : '' }}>
                        <label for="radio-6" class="radio-label">Limited offers</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row add_user_form_row add_maximum_offer_input {{ old('offer_quota', $data->offer_quota_set ?? '') == 1 ? 'limited_ofr_inpts' : '' }}">
            <div class="form-group col-md-12 mb-3">
                <input type="number" class="form-control"
                    placeholder="Enter maximum number of offers" name="max_number_of_offer" value="{{ $data->offer_quota }}">
            </div>
            @error('max_number_of_offer')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>
        <div class="form-row mt-2 organaization_button">
            <button type="submit" class="btn btn-primary Create_Btn mr-2 mb-3">Update</button>
            <!-- <a href="{{url('organisations')}}"
                class="btn btn-primary Cancle_outline_btn mb-3">Cancel</a> -->
          <button type="button" class="btn btn-primary Cancle_outline_btn mb-3"
        onclick="window.location.href='{{ url('/organisations') }}'">Cancel</button>
        </div>
              </form>
    </div>
</div>
 <script>
    window.savedTaxRegistrations = @json($data->organisationtaxregistrationsm ?? []);
</script>
@push('scripts')
<script src="{{ url('public/assets/js/custom/createorg.js') }}"></script>
@endpush
@endsection
