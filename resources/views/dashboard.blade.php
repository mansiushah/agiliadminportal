@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="right_bottom_ttl">
  <div class="right_bottom_ttl_rht">
      <h4>Dashboard</h4>
      <p>Overview of your admin panel statistics</p>
  </div>

  <div class="right_bottom_ttl_lft">
     <!--  <a href="{{route('category.add')}}" class="add_Organisations_btn">
          <i class="fa fa-plus" aria-hidden="true"></i>
          <span>Add Category</span>
      </a> -->
  </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <div class="dashboard_card">
            <div class="dashboard_card_lft">
                <p>Total Organisations</p>
                <h4>{{$organisationCount}}</h4>
            </div>
            <div class="dashboard_card_rht">
                <img src="{{ url('public/assets/img/Total-Organisations.svg') }}" alt="Total-Organisations" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <div class="dashboard_card dashboard_card_two">
            <div class="dashboard_card_lft">
                <p>Total Users</p>
                <h4>{{$userCount}}</h4>
            </div>
            <div class="dashboard_card_rht">
                <img src="{{ url('public/assets/img/active-user.svg') }}" alt="active-user"
                    class="img-fluid">
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <div class="dashboard_card dashboard_card_three">
            <div class="dashboard_card_lft">
                <p>Total Offers</p>
                <h4>{{$offersCount}}</h4>
            </div>
            <div class="dashboard_card_rht">
                <img src="{{ url('public/assets/img/active-offer.svg') }}" alt="active-offer" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <div class="dashboard_card dashboard_card_four">
            <div class="dashboard_card_lft">
                <p>Categories</p>
                <h4>{{$categoryCount}}</h4>
            </div>
            <div class="dashboard_card_rht">
                <img src="{{ url('public/assets/img/card-categories.svg') }}" alt="card-categories" class="img-fluid">
            </div>
        </div>
    </div>

</div>
@endsection
