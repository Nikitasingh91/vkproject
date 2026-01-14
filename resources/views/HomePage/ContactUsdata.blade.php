@extends('layouts.dashboardLayout')
@section('title', 'Contact Us Data')

@section('content')
<x-content-div heading="Contact Form Submissions">
    <x-card-element header="Contact Form Data">
        <x-data-table></x-data-table>
    </x-card-element>
</x-content-div>
@endsection

@section('script')
<script type="text/javascript">
    let table = "";
    $(function () {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: "{{ route('managecontactdata') }}",
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', title: "Sr.No." },
                { data: '{{ \App\Models\ContactUsModel::FIRST_NAME }}', name: '{{ \App\Models\ContactUsModel::FIRST_NAME }}', title: 'First Name' },
                { data: '{{ \App\Models\ContactUsModel::LAST_NAME }}', name: '{{ \App\Models\ContactUsModel::LAST_NAME }}', title: 'Last Name' },
                { data: '{{ \App\Models\ContactUsModel::EMAIL }}', name: '{{ \App\Models\ContactUsModel::EMAIL }}', title: 'Email' },
                { data: '{{ \App\Models\ContactUsModel::COUNTRY_CODE }}', name: '{{ \App\Models\ContactUsModel::COUNTRY_CODE }}', title: 'Country Code' },
                { data: '{{ \App\Models\ContactUsModel::PHONE_NUMBER }}', name: '{{ \App\Models\ContactUsModel::PHONE_NUMBER }}', title: 'Phone' },
                { data: '{{ \App\Models\ContactUsModel::MESSAGE }}', name: '{{ \App\Models\ContactUsModel::MESSAGE }}', title: 'Message' },
                { data: '{{ \App\Models\ContactUsModel::IP_ADDRESS }}', name: '{{ \App\Models\ContactUsModel::IP_ADDRESS }}', title: 'IP' },
                { data: '{{ \App\Models\ContactUsModel::USER_AGENT }}', name: '{{ \App\Models\ContactUsModel::USER_AGENT }}', title: 'User Agent' },
                { data: '{{ \App\Models\ContactUsModel::STATUS }}', name: '{{ \App\Models\ContactUsModel::STATUS }}', title: 'Status' },
                { data: '{{ \App\Models\ContactUsModel::CREATED_AT }}', name: '{{ \App\Models\ContactUsModel::CREATED_AT }}', title: 'Created At' },
            ],
            order: [[10, "desc"]]
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection