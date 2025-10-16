@extends('layouts.master')
@section('title', 'Category')
@section('content')
<div class="right_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Categories</h4>
        <p>Manage categories and their order</p>
    </div>
    <div class="right_bottom_ttl_lft">
        <a href="{{route('category.add')}}" class="add_Organisations_btn">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>Add Category</span>
        </a>
    </div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main">
        <div class="manage_user_main_card_lft">
            <h3>Category List</h3>
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
                    <th>Category Name</th>
                    <th>Organisations</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{ $row->organisation_count }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{route('category.edit', $row->id)}}" class="table_pencil_btn mr-2">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            @if($row->organisation_count == 0)
                            <a href="#" class="table_delete_btn" data-bs-toggle="modal"
                                data-bs-target="#DeleteOrganaizationModal" data-id="{{ $row->id }}" data-name="{{ $row->name }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            @else
                            <a href="#" class="table_delete_btn" data-bs-toggle="modal"
                                data-bs-target="#DeleteOrganaizationModals">
                                <i class="fa fa-trash text-secondary" aria-hidden="true"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
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
                                    <h4>Delete Category</h4>
                                    <p class="mb-3">Are you sure you want to delete
                                        this category?</p>
                                    <div class="Organaization_delete_Modal_Btm">
                                        <button type="submit"
                                            class="btn btn-primary Cancle_outline_btn mb-3 mr-sm-0 mr-3">Cancel</button>
                                        <form id="deleteCategoryForm" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-primary Confirm_Delete_Btn api api_delete_btn ml-3 mb-3">Confirm Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- Modal -->
    <div class="modal fade add_user_moidal" id="DeleteOrganaizationModals" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content add_user_modal_content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-4">
                    <div class="add_user_success_card text-center">
                        <img src="{{url('/public/assets/img/Vector.svg')}}">
                    </br>
                        <h4>Can’t Delete</h4>
                        <p class="mb-3">This category is currently assigned to one or more organisations.
                            Please remove or reassign those organisations before deleting.</p>
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
    const deleteForm = document.getElementById('deleteCategoryForm');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const categoryId = button.getAttribute('data-id');
        const categoryName = button.getAttribute('data-name');

        // Update form action dynamically
        deleteForm.action = `/php/M-0402/Ad-Agilis/Ad-agilis-admin/category-delete/${categoryId}`;
    });
});
</script>

@endpush
