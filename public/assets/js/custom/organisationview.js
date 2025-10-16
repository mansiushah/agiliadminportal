$(document).ready(function () {
    let table = $('#OrganisationsUserTable').DataTable({
        processing: true,
        serverSide: true,
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right">',
                previous: '<i class="fa fa-angle-left">'
            }
        },
        ajax: {
            url: "{{ route('organisations.view', $Organisationdata->id) }}",
            data: function (d) {
                d.role_id = $('#filterRole').val(); // Send selected role
                d.status = $('#filterStatus').val(); // If you have status filter
            }
        },
        columns: [
            {data: 'name', name: 'name'},            // first_name + last_name
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'role', name: 'role'},            // role name
            {data: 'offer_quota', name: 'wallet_value'},            // role name
            {data: 'wallet_value', name: 'wallet_value'},            // role name
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // 🔄 Reload table on filter change
    $('#filterRole, #filterStatus').on('change', function () {
        table.ajax.reload();
    });
});
//model code
/*$(document).on('click', '.openDeleteModal', function () {
    let id = $(this).data('id');
    let url = "{{ route('organisations.user.destroy', ':id') }}";
    url = url.replace(':id', id);

    $('#DeleteOrganaizationModal2 form').attr('action', url);
});*/

$(document).on('click', '.openResetModal', function () {
    let userId = $(this).data('id');
    $('#resetpassordUser').data('id', userId);  // store user id in button
});

$(document).on('click', '#resetpassordUser', function () {
    let userId = $(this).data('id');
    let url = "{{ route('organisations.reset.user.password', ':id') }}";
    url = url.replace(':id', userId);

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
        },
        success: function (response) {
            // Close modal
            $('#EditOrganaizationModal').modal('hide');

            // Wait until modal is hidden, then reload page
            $('#EditOrganaizationModal').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function (xhr) {
            alert('Something went wrong.');
        }
    });
});

