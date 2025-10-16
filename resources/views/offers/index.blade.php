@extends('layouts.master')
@section('title', 'Offer')
  <style>
        #OrganisationsTable_wrapper .dataTables_filter {
            /* display: none; */
        }

        #OrganisationsTable_wrapper .dataTables_filter {
            /* display: none; */
            position: absolute;
            top: -66px;
            right: 225px;
        }

        #OrganisationsTable_wrapper .dataTables_filter input {
            height: 50px;
        }

        #OrganisationsTable_wrapper .dataTables_filter::before {
            font-family: fontAwesome;
            content: "\f002 ";
            color: #5E5E6D;
            border: 0;
            display: inline-block;
            left: 67px;
            position: absolute;
            top: 15px;
        }

        @media(max-width:767px) {
            #OrganisationsTable_wrapper .dataTables_filter {
                right: auto;
                top: -96px;
                left: 0;
            }

            #OrganisationsTable_wrapper .dataTables_filter::before {
                left: 20px;
                top: 38px;
            }
            .manage_user_main_organizations {
                padding-bottom: 70px;
                flex-direction: column;
                align-items: flex-start;
            }

            #OrganisationsTable_wrapper .dataTables_filter,
            #OrganisationsTable_wrapper .dataTables_filter label,
            .user_mian_rights,
            .user_mian_rights .user_select_drpdwn,
            .user_mian_rights .user_select_drpdwn select,
            #OrganisationsTable_wrapper .dataTables_filter input {
                width: 100%;
            }
            .user_mian_rights .user_select_drpdwn{
                margin-right: 0;
            }
            .dataTables_wrapper .dataTables_filter input{
                margin-left: 0;
            }
        }

        @media(max-width:420px) {
            .manage_user_main_organizations {
                padding-bottom: 50px;
            }
            #OrganisationsTable_wrapper .dataTables_filter{
                left: 0;
            }
        }
    </style>
@section('content')
 <div class="right_bottom_ttl">
                        <div class="right_bottom_ttl_rht">
                            <h4>All Offers</h4>
                            <p>Manage all offers across all organisations</p>
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
                                <h3>Offers List</h3>
                            </div>

                            <div class="manage_user_main_card_rht user_mian_rights all_offer_tbl">

                                <div class="user_select_drpdwn">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>All Organisations</option>
                                        <option value="1">Fico Consultant</option>
                                        <option value="2">MM Fico Consultant</option>
                                        <option value="3">SD Consultant</option>
                                    </select>
                                </div>

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
                                    <th>Offer Title</th>
                                    <th>Company</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Payment Link</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Summer Yoga Offer</td>
                                    <td>ACME LTD.</td>
                                    <td>John Doe</td>
                                    <td>15/06/2025</td>
                                    <td class="offer_link_div">
                                        <a href="#" class="offer_link_txt">https://stripe.com/d...</a>
                                    </td>
                                    <td>
                                        <span class="user_enabled_btn">Enabled</span>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('offer.view')}}" class="table_eye_btn mr-2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Tech Consultation Deal</td>
                                    <td>Tech Solutions Inc</td>
                                    <td>Sarah Wilson</td>
                                    <td>08/06/2025</td>
                                    <td class="offer_link_div">
                                        <a href="#" class="offer_link_txt">https://stripe.com/d...</a>
                                    </td>
                                    <td>
                                        <span class="user_enabled_btn">Enabled</span>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('offer.view')}}" class="table_eye_btn mr-2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Spa Package Special</td>
                                    <td>Green Valley Spa</td>
                                    <td>Michael Brown</td>
                                    <td>23/05/2025</td>
                                    <td class="offer_link_div">
                                        <a href="#" class="offer_link_txt">https://stripe.com/k...</a>
                                    </td>
                                    <td>
                                        <span class="user_enabled_btn">Enabled</span>
                                    </td>
                                    <td>
                                       <div>
                                            <a href="{{ route('offer.view')}}" class="table_eye_btn mr-2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Fitness Membership Deal</td>
                                    <td>Downtown Fitness</td>
                                    <td>Emily Davis</td>
                                    <td>12/05/2025</td>
                                    <td class="offer_link_div">
                                        <a href="#" class="offer_link_txt">https://stripe.com/i...</a>
                                    </td>
                                    <td>
                                        <span class="user_disabled_btn">Disabled</span>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('offer.view')}}" class="table_eye_btn mr-2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Meditation Package</td>
                                    <td>Happy Life Clinic</td>
                                    <td>John Doe</td>
                                    <td>18/04/2025</td>
                                    <td class="offer_link_div">
                                        <a href="#" class="offer_link_txt">https://stripe.com/7...</a>
                                    </td>
                                    <td>
                                        <span class="user_enabled_btn">Enabled</span>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('offer.view')}}" class="table_eye_btn mr-2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                                <!-- ************************ -->
                            </tbody>
                        </table>
                    </div>
                     <!-- Modal -->
    <div class="modal fade add_user_moidal" id="DeleteOrganaizationModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content add_user_modal_content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-4">
                    <div class="add_user_success_card text-center">
                        <h4>Delete Organisation</h4>
                        <p class="mb-2">Are you sure you want to delete this Organisation?</p>
                        <p>This will delete all of their Users, Offers, API keys, and files.</p>
                        <div class="Organaization_delete_Modal_Btm">
                            <button type="submit"
                                class="btn btn-primary Cancle_outline_btn mb-3 mr-sm-0 mr-3">Cancel</button>
                            <button type="submit" class="btn btn-primary Confirm_Delete_Btn mr-2 mb-3">Confirm
                                Delete</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
 @endsection
