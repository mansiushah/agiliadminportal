@extends('layouts.master')
@section('title', 'Organisations Requests')
<style>
#OrganisationsTable_wrapper .dataTables_filter {
    display: none;
}
</style>
@section('content')
<div class="right_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Org. Requests</h4>
        <p>Review and manage organisation registration requests</p>
    </div>
    <!-- <div class="right_bottom_ttl_lft">
        <a href="#" class="add_Organisations_btn">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>Add New Organisations</span>
        </a>
    </div> -->
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main manage_user_main_organizations">
        <div class="manage_user_main_card_lft">
            <h3>Requests</h3>
        </div>
    </div>
    <table id="OrganisationsTable" class="display table-responsive-xl" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Company Name</th>
                <th>Trading Name</th>
                <th>Company No.</th>
                <th>VAT No.</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>ABC Ltd.</td>
                <td>ABC Ltd.</td>
                <td>12345678</td>
                <td>GB123456</td>
                <td>12 King Street, London</td>
                <td><span class="pending_span">Pending</span></td>
                <td>
                    <div class="d-flex">
                    <a href="#" class="approve_btn">Approve</a>
                    <a href="#" class="approve_btn edit_btns">Edit</a>
                    <a href="#" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>02</td>
                <td>Nova Tech Ltd</td>
                <td>BrightWave</td>
                <td>84726351</td>
                <td>-</td>
                <td>50 Main Ave, Manchester</td>
                <td><span class="pending_span">Pending</span></td>
                <td>
                    <div class="d-flex">
                    <a href="#" class="approve_btn">Approve</a>
                    <a href="#" class="approve_btn edit_btns">Edit</a>
                    <a href="#" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>03</td>
                <td>BrightWave Group</td>
                <td>Reach Media </td>
                <td>72836482</td>
                <td>GB645372</td>
                <td>22 Hope Rd, Birmingham</td>
                <td><span class="approve_span">Approve</span></td>
                <td></td>
            </tr>
            <tr>
                <td>02</td>
                <td>Nova Tech Ltd</td>
                <td>BrightWave</td>
                <td>84726351</td>
                <td>-</td>
                <td>50 Main Ave, Manchester</td>
                <td><span class="pending_span">Pending</span></td>
                 <td>
                    <div class="d-flex">
                    <a href="#" class="approve_btn">Approve</a>
                    <a href="#" class="approve_btn edit_btns">Edit</a>
                    <a href="#" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>03</td>
                <td>BrightWave Group</td>
                <td>Reach Media </td>
                <td>72836482</td>
                <td>GB645372</td>
                <td>22 Hope Rd, Birmingham</td>
                <td><span class="approve_span">Approve</span></td>
                <td></td>
            </tr>
            <tr>
                <td>03</td>
                <td>BrightWave Group</td>
                <td>Reach Media </td>
                <td>72836482</td>
                <td>GB645372</td>
                <td>22 Hope Rd, Birmingham</td>
                <td><span class="approve_span">Approve</span></td>
                <td></td>
            </tr>
            <tr>
                <td>02</td>
                <td>Nova Tech Ltd</td>
                <td>BrightWave</td>
                <td>84726351</td>
                <td>-</td>
                <td>50 Main Ave, Manchester</td>
                <td><span class="pending_span">Pending</span></td>
                 <td>
                    <div class="d-flex">
                    <a href="#" class="approve_btn">Approve</a>
                    <a href="#" class="approve_btn edit_btns">Edit</a>
                    <a href="#" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>02</td>
                <td>Nova Tech Ltd</td>
                <td>BrightWave</td>
                <td>84726351</td>
                <td>-</td>
                <td>50 Main Ave, Manchester</td>
                <td><span class="pending_span">Pending</span></td>
                 <td>
                    <div class="d-flex">
                    <a href="#" class="approve_btn">Approve</a>
                    <a href="#" class="approve_btn edit_btns">Edit</a>
                    <a href="#" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
            </tr>
            <!-- ************************ -->
        </tbody>
    </table>
</div>
@endsection
