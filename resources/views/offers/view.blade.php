@extends('layouts.master')
@section('title', 'Offer Details')
   <style>
        #OrganisationsTable_wrapper .dataTables_filter {
            display: none;
        }
    </style>
@section('content')
<div class="right_bottom_ttl offer_detail_ttl">
                        <div class="right_bottom_ttl_lft d-flex ">
                            <a href="#" class="user_back_btn"><img src="{{ url('public/assets/img/back-arrow.svg') }}" alt="back-arrow"
                                    class="img-fluid"></a>
                            <h4 class="ml-3 mb-0">Offer Details</h4>
                        </div>
                        <div class="right_bottom_ttl_rht">
                            <a href="#" class="Disable_Offer_btn" data-bs-toggle="modal"
                                data-bs-target="#DeleteOrganaizationModal">Disable This Offer</a>
                        </div>

                    </div>
                    <div class="summer_offer_card manage_user_main_card mb-3">
                        <div class="summer_offer_card_lft">
                            <img src="{{ url('public/assets/img/summer-image.svg') }}" alt="summer-image" class="img-fluid">
                        </div>
                        <div class="summer_offer_card_rht">
                            <div class="summer_offer_tag pt-3 mb-3">
                                <span class="health_tag">Health & Fitness</span>
                                <span class="Enabled_tag">Enabled</span>
                            </div>
                            <div class="summer_offer_ttl mt-4">
                                <h3>Summer Yoga Offer</h3>
                                <p>Get half off on all summer items for a limited time only. Shop now before stock runs
                                    out!</p>
                            </div>
                            <div class="summer_offer_date mt-4 mb-3">
                                <div class="summer_offer_date_lft">
                                    <h6>Start Date & Time </h6>
                                    <p class="d-flex alig-items-center"><img src="{{ url('public/assets/img/calender.svg') }}"
                                            alt="calender" class="img-fluid mr-2"><span>01-06-2025 at 09:00</span></p>
                                </div>
                                <div class="summer_offer_date_lft mr-0">
                                    <h6>Start Date & Time </h6>
                                    <p class="d-flex alig-items-center"><img src="{{ url('public/assets/img/calender.svg') }}"
                                            alt="calender" class="img-fluid mr-2"><span>01-06-2025 at 09:00</span></p>
                                </div>
                            </div>
                            <div>

                                <a href="#" class="visit_offer_btn ">
                                    <img src="{{ url('public/assets/img/vistit-url.svg') }}" alt="vistit-url" class="img-fluid pr-2">
                                    <span>Visit Offer URL</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="manage_user_main_card mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-2">
                                <div class="offer_ttl_crd">
                                    <div class="offer_ttl_crd_lft">
                                        <p>Total Views</p>
                                        <h4>15,234</h4>
                                    </div>
                                    <div class="offer_ttl_crd_rht">
                                        <img src="{{ url('public/assets/img/eye-blie-btn.svg') }}" alt="eye-blie-btn" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-2">
                                <div class="offer_ttl_crd">
                                    <div class="offer_ttl_crd_lft">
                                        <p>Total Clicks</p>
                                        <h4>2,878</h4>
                                    </div>
                                    <div class="offer_ttl_crd_rht">
                                        <img src="{{ url('public/assets/img/click-blue-btn.svg') }}" alt="click-blue-btn" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="offer_details_main_card">
                                <h2>Region Info</h2>
                                <div class="offer_details_sub_card">
                                    <div class="offer_details_sub_card_txt">
                                        <h6>Location</h6>
                                        <h3>Wall Street, New York, NY 10005, USA</h3>
                                    </div>

                                    <div class="offer_details_sub_card_txt">
                                        <h6>Radius</h6>
                                        <h3>5 miles</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="offer_details_main_card">
                                <h2>Stripe Payment Link</h2>
                                <div class="offer_details_sub_card">
                                    <div class="offer_details_sub_card_txt">
                                        <a href="#" class="offer_details_links">https://stripe.com/dfd6541dfdfser</a>
                                        <a href="#" class="add_user_btn" data-bs-toggle="modal"
                                data-bs-target="#ReSendEmail">Re-send Email</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="manage_user_main_card alloffer_card mt-3">
                        <h4>Terms & Conditions</h4>
                        <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived
                            not only five centuries, but also the leap into electronic typesetting, remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived
                            not only five centuries, but also the leap into electronic typesetting, remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing.</p>
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
                        <h4>You want to disable this offer?</h4>
                        <p class="mb-2">Disabled offers will not appear in the app, even if their start date is in the
                            future. The offer creator will also not be able to amend it.</p>

                        <div class="Organaization_delete_Modal_Btm mt-5">
                            <button type="submit" class="btn btn-primary Cancle_outline_btn mb-3 mr-3">Cancel</button>
                            <button type="submit" class="btn btn-primary Confirm_Delete_Btn mr-2 mb-3">Confirm
                                Disable</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->


    <!-- Modal 1-->
    <div class="modal fade add_user_moidal" id="ReSendEmail" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content add_user_modal_content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-4">
                    <div class="add_user_success_card text-center">
                        <h4>Send Payment Link</h4>
                        <p class="mb-2">Are you sure you want to re-send the payment link to this user's email?</p>

                        <div class="Organaization_delete_Modal_Btm mt-5">
                            <button type="submit" class="btn btn-primary Cancle_outline_btn mb-3 mr-3">Cancel</button>
                            <button type="submit" class="btn btn-primary Create_Btn Send_Btn ml-3 mb-3">Send</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal 1-->
@endsection
