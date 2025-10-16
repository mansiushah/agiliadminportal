@extends('layouts.master')
@section('title', 'Promo codes')
@section('content')
<div class="right_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Promo codes</h4>
        <p>Manage Promo codes your applications</p>
    </div>
    <div class="right_bottom_ttl_lft">
        <a href="{{route('promocode.add')}}" class="add_Organisations_btn">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>Add Promo codes</span>
        </a>
    </div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main">
        <div class="manage_user_main_card_lft">
            <h3>Promo codes</h3>
        </div>
        <div class="manage_user_main_card_rht">
            <div class="organazation_table_search">
                <form>
                    <input type="text" placeholder="Search organisations...">
                    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                </form>
            </div>
        </div>
    </div>
    @include('flash-message')
    <div class="table-responsive">
        <table id="OrganisationsTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Promo code</th>
                    <th>Discount</th>
                    <th>Organisation</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                <tr>
                <td>{{ $i++ }}</td>
                <td class="api_key_div">
                    <a href="#" class="api_link_txt mb-2">{{ $row->promo_code }}</a>
                    <span
                        class="api_copy_url ml-2 mb-2 copy-promocode"
                        data-key="{{ $row->promo_code }}"
                        style="cursor:pointer;"
                        title="Copy Promo code"
                    >
                        <i class="fa fa-clone" aria-hidden="true"></i>
                    </span>
                </td>
                <td>{{ $row->percentage_discount }}% OFF</td>
                <td>{{ $row->organisation?->company_name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                <td><span class="api_active">Active</span></td>
                <td>
                    <div class=" ">
                        <a href="#" class="table_delete_btn" data-bs-toggle="modal"
                            data-bs-target="#DeleteOrganaizationModal" data-id="{{ $row->id }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
 <div class="modal fade add_user_moidal" id="DeleteOrganaizationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content add_user_modal_content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4">
                <div class="add_user_success_card text-center">
                    <h4>Delete Promo Code?</h4>
                    <p class="mb-3">Are you sure you want to delete this promo code?</p>
                    <div class="Organaization_delete_Modal_Btm">
                        <button type="submit"
                            class="btn btn-primary Cancle_outline_btn mb-3 mr-sm-0 mr-3">Cancel</button>
                        <form id="deletePromocodeForm" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-primary Confirm_Delete_Btn api api_delete_btn ml-3 mb-3">Confirm
                                Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('DeleteOrganaizationModal');
    const deleteForm = document.getElementById('deletePromocodeForm');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const categoryId = button.getAttribute('data-id');

        // Update form action dynamically
        deleteForm.action = `/php/M-0402/Ad-Agilis/Ad-agilis-admin/promocode-delete/${categoryId}`;
    });
});
</script>
@endpush
