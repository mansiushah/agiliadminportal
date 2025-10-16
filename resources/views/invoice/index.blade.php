@extends('layouts.master')
@section('title', 'Manage Invoice')
 <style>
        #OrganisationsTable_wrapper .dataTables_filter {
            display: none;
        }
    </style>
@section('content')
<div class="right_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Invoices</h4>
        <p>Download and view the invoices</p>
    </div>

    <div class="right_bottom_ttl_lft">
        <!-- <a href="#" class="add_Organisations_btn">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>Add New Organisations</span>
        </a> -->

        <div class="user_select_drpdwn">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected>All Organisations</option>
                <option value="1">Fico Consultant</option>
                <option value="2">MM Fico Consultant</option>
                <option value="3">SD Consultant</option>
            </select>
        </div>

    </div>

</div>
<div class="manage_user_main_card">
    <div class="manage_user_main manage_user_main_organizations">
        <div class="manage_user_main_card_lft">
            <h3>Manage Invoices</h3>
        </div>

        <div class="manage_user_main_card_rht user_mian_rights all_offer_tbl">

            <!-- <div class="user_select_drpdwn">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>All Organisations</option>
                    <option value="1">Fico Consultant</option>
                    <option value="2">MM Fico Consultant</option>
                    <option value="3">SD Consultant</option>
                </select>
            </div> -->

            <div class="organazation_table_search">
                <form>
                    <input type="text" placeholder="Search organisations...">
                    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                </form>
            </div>
        </div>
    </div>
    <table id="OrganisationsTable" class="display table-responsive-xl" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Offer Title</th>
                <th>Organisation</th>
                <th>Product Name</th>
                <th>Invoice ID</th>
                <th>Billing Date</th>
                <th>Target Location</th>
                <th>Radius (mi)</th>
                <th>Cost</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                <td>01</td>
                <td>Gym Membership Deal</td>
                <td>ACME LTD.</td>
                <td>ACME</td>
                <td>INV-2025-001</td>
                <td>04 June 2025</td>
                <td>Bronx, NY, USA</td>
                <td>10</td>
                <td>£38.60</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('invoice.view') }}" class="table_eye_btn mr-2">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="table_download_btn">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </div>
                </td>
            </tr>


            <tr>
                <td>02</td>
                <td>Summer Sale</td>
                <td>Tech Solutions Inc</td>
                <td>Tech Solutions</td>
                <td>INV-2025-002</td>
                <td>02 June 2025</td>
                <td>Brooklyn, NY, USA</td>
                <td>8</td>
                <td>£27.50</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('invoice.view') }}" class="table_eye_btn mr-2">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="table_download_btn">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>
@endsection
