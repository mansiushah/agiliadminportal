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
</div>
<div class="manage_user_main_card">
    <div class="manage_user_main manage_user_main_organizations">
        <div class="manage_user_main_card_lft">
            <h3>Requests</h3>
        </div>
    </div>
      @include('flash-message')
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
             @php $i = 1; @endphp
             @foreach($data as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->company_name }}</td>
                <td>{{ $row->trading_name }}</td>
                <td>{{ $row->company_number }}</td>
                <td>GB123456</td>
                <td>{{ $row->company_address_line1 }} {{ $row->company_address_line2 }} {{ $row->company_address_state }} {{ $row->company_address_city }}</td>
                @if($row->status == 'R')
                <td><span class="reject_span">Rejected</span></td>
                @elseif($row->status == 'A')
                <td><span class="approve_span">Approved</span></td>
                @elseif($row->status == 'P')
                <td><span class="pending_span">Pending</span></td>
                @else
                <td>--</td>
                @endif
                @if($row->status == 'P')
                <td>
                    <div class="d-flex">
                    <a href="{{ route('orgrequestappove',['id' => $row->id]) }}" class="approve_btn">Approve</a>
                    <a href="{{route('request.edit', $row->id)}}" class="approve_btn edit_btns">Edit</a>
                    <a href="{{ route('orgrequestreject',['id' => $row->id]) }}" class="approve_btn reject_btns">Reject</a>
                    </div>
                </td>
                @else
                <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
