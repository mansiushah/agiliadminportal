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
<form  method="POST" action="{{ route('request.update') }}">
    <input type="hidden" name="id" value="{{ $data->id }}"/>
  @csrf
         <div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
                <label>Company name*</label>
                <input type="text" class="form-control" name="company_name" placeholder="Company name" value="{{ $data->company_name }}">
                @error('company_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
         </div>
         <div class="form-row add_user_form_row">
            <div class="form-group col-md-12">
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
                <label>Company address*</label>
                 <input type="text" id="autocomplete" placeholder="Enter address" class="w-100" value="{{ $data->company_address_line1 }} {{ $data->company_address_city }} {{ $data->company_address_country }}">
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
