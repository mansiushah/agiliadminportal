@extends('layouts.master')

@section('title', 'Category Add')

@section('content')
<div class="right_bottom_ttl mb-4">
<div class="right_bottom_ttl_lft">
    <h4>Categories</h4>
    <p>Manage categories and their order</p>
</div>
<div class="right_bottom_ttl_rht"></div>
</div>

<div class="manage_user_main_card">
    <div class="manage_user_card_ttl">
        <h5>Categories List</h5>
    </div>

    <div class="add_user_form mt-3">
        <form method="POST" action="{{ route('category.store') }}">
           @csrf
            <div class="form-row add_user_form_row">
                <div class="form-group col-md-12 mb-3">
                  <label for="uname">Category name*</label>
                  <input type="text" id="uname" name="category_name"
                    class="form-control" minlength="2" value="{{ old('category_name') }}" data-error=".errorTxt1"
                  />
                   @error('category_name')
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
