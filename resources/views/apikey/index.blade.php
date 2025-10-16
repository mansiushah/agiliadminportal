@extends('layouts.master')
@section('title', 'Manage API Keys')
<style>
    #OrganisationsTable_wrapper .dataTables_filter {
        display: none;
    }
</style>
@section('content')
<div class="right_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Manage API Keys</h4>
        <p>Manage API keys for your applications</p>
    </div>
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main manage_user_main_organizations pb-0">
        <div class="manage_user_main_card_lft">
            <h3>API Keys</h3>
        </div>
    </div>
    <div class="table-responsive">
    <table id="OrganisationsTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>API Name</th>
                <th>Organisation</th>
                <th>User Name</th>
                <th>API Key</th>
                <th>Created</th>
                <th>Last used</th>
                <th>Expires</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($data as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->key_name }}</td>
                <td>{{ $row->user?->organisation?->company_name ?? 'No Organisation' }}</td>
                <td>{{ $row->user->full_name }}</td>
                <td class="api_key_div">
                    <a href="#" class="api_link_txt mb-2">{{ $row->aws_key_value }}</a>
                    <span
                        class="api_copy_url ml-2 mb-2 copy-api-key"
                        data-key="{{ $row->aws_key_value }}"
                        style="cursor:pointer;"
                        title="Copy API Key"
                    >
                        <i class="fa fa-clone" aria-hidden="true"></i>
                    </span>
                </td>
                <td>{{ $row->last_used_date ? \Carbon\Carbon::parse($row->last_used_date)->format('d/m/Y') : '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($row->expiry_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                <td><span class="api_active">Active</span></td>
                <td>
                    <div class=" ">
                        <a href="#" class="table_delete_btn" data-bs-toggle="modal"
                            data-bs-target="#DeleteOrganaizationModal">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </td>
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
                    <h4>Delete API Key?</h4>
                    <p class="mb-3">This action cannot be undone. Any system or integration using this API key will
                        stop working.</p>
                    <div class="Organaization_delete_Modal_Btm d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-primary Cancle_outline_btn mb-3 mr-sm-0 mr-3">Cancel</button>
                            <form action="{{ route('api.keys.destroy', $row->id) }}" method="POST" >
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
            </tr>

             @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
