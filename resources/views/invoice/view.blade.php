@extends('layouts.master')
@section('title', 'Manage Invoice')
<style>
        #OrganisationsTable_wrapper .dataTables_filter {
            display: none;
        }
</style>
@section('content')
<div class="rignt_section_bottom">
    <div class="right_bottom_ttl">
        <div class="right_bottom_ttl_rht d-flex ">
            <a href="#" class="user_back_btn mr-3"><img src="{{ url('public/assets/img/back-arrow.svg') }}" alt="back-arrow"
                    class="img-fluid"></a>
            <h4>Invoices Details</h4>
        </div>

        <div class="right_bottom_ttl_lft">
            <!-- <a href="#" class="add_Organisations_btn">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>Add New Organisations</span>
            </a> -->

            <div class="user_select_drpdwn">
                <a href="#" class="add_Organisations_btn w-100 px-4">
                    <i class="fa fa-download mr-2" aria-hidden="true"></i>
                    <span>Download PDF</span>
                </a>
            </div>

        </div>

    </div>
    <div class="manage_user_main_card">
        <div class="invoice_details_top mb-4">
            <div class="invoice_details_top_lft">
                <div class="invoice_details_top_logo">
                    <img src="{{ url('public/assets/img/Invoice-Logo.svg') }}" alt="Invoice-Logo" class="img-fluid">
                </div>
                <div class="invoice_details_top_details mt-4">
                    <p><span>Company name: </span><span> Agilis Dating Ltd</span></p>
                    <p><span>Company number: </span><span> 14923748</span></p>
                    <p><span>Company address: </span><span> 39 Hillfield Avenue, Morden, Surrey SM4
                            6BA</span></p>
                    <p><span>VAT number:</span><span> GB447013024</span></p>
                </div>

            </div>
            <div class="invoice_details_top_rht">
                <h2>Invoice</h2>
                <h6>INV-2025-001</h6>
            </div>
        </div>
        <div class="invoice-shipping-details ">
            <div class="row">
                <div class="col-sm-6 col-12 mb-3 ">
                    <div class="invoice_billto">
                        <h2>Bill To</h2>
                    </div>
                    <div class="invoice_billto_details">
                        <p><span><b>Company name:</b></span><span>[COMPANY NAME]</span></p>
                        <p><span><b>Company number:</b></span><span>[COMPANY NUMBER]</span></p>
                        <p><span><b>Company address:</b></span><span>[COMPANY ADDRESS]</span></p>
                        <p><span><b>VAT number:</b></span><span>[VAT NUMBER]</span></p>
                    </div>
                </div>
                <div class="col-sm-3 col-12 mb-3 ">
                    <div class="invoice_billto">
                        <h2>Invoice Date</h2>
                    </div>
                    <div class="invoice_billto_details">
                        <p>06/04/2025</p>
                    </div>
                </div>
                <div class="col-sm-3 col-12 invoice_total_billto">
                    <div>
                        <div class="invoice_billto">
                            <h2>Invoice Total</h2>
                        </div>
                        <div class="invoice_billto_details">
                            <p>£38.60</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice_details_table mt-4">
            <table class="table table-responsive-md">
                <thead>
                    <tr>
                        <th>Offer Title</th>
                        <th>Target Location</th>
                        <th>Radius</th>
                        <th>Total duration (hours)</th>
                        <th># Ad Units</th>
                        <th>Ad Unit price</th>
                        <th>Total cost</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gym Membership Deal</td>
                        <td>Bronx, NY, USA</td>
                        <td>10 miles</td>
                        <td>30</td>
                        <td>11580</td>
                        <td>£0.01</td>
                        <td>£115.80</td>
                    </tr>
                    <tr class="border-bottom-white">
                        <td colspan="6">Subtotal</td>
                        <td>£115.80</td>
                    </tr>
                    <tr>
                        <td colspan="6">VAT (20%)</td>
                        <td>£23.16</td>
                    </tr>
                    <tr class="border-bottom-white font_strong">
                        <div class="invoice_detail_total">
                            <td colspan="6"><b>Total Amount</b></td>
                            <td><b>£138.96</b></td>
                        </div>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
