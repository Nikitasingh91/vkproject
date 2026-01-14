@extends('layouts.dashboardLayout')
@section('title', 'Manage Testimonials')
@section('content')
    <x-dashboard-container container_header="Manage Testimonials">
        <x-card>
            <x-card-header>Add / Edit Testimonial</x-card-header>
            <x-card-body>
                <x-form>
                    <x-input type="hidden" name="id" id="id" value=""></x-input>
                    <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                    <x-input-with-label-element name="name" id="name" required 
                        placeholder="Customer Name" label="Name"></x-input-with-label-element>

                    <x-input-with-label-element name="company_name" id="company_name" 
                        placeholder="Company Name" label="Company Name"></x-input-with-label-element>

                    <x-text-area-with-label id="message" name="message" required
                        placeholder="Testimonial Message" label="Message"></x-text-area-with-label>

                    <x-select-label-group required name="status" id="status" label_text="Status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-select-label-group>

                    <x-input-with-label-element type="number" name="sorting" id="sorting" 
                        placeholder="Sorting Order" label="Sorting"></x-input-with-label-element>

                    <x-form-buttons></x-form-buttons>
                </x-form>
            </x-card-body>
        </x-card>

        <x-card>
            <x-card-header>Testimonials Data</x-card-header>
            <x-card-body>
                <x-data-table></x-data-table>
            </x-card-body>
        </x-card>
    </x-dashboard-container>
@endsection

@section('script')
<script type="text/javascript">
    let site_url = '{{ url('/') }}';
    var table = "";
    $(function() {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('testimonialsDataTable') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                }
            },
            "order": [[1, 'asc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false, title: "Action" },
                { data: 'id', name: 'id', title: "ID" },
                { data: 'name', name: 'name', title: "Name" },
                { data: 'company_name', name: 'company_name', title: "Company" },
                { data: 'message', name: 'message', title: "Message" },
                { data: 'status', name: 'status', title: "Status" },
                { data: 'sorting', name: 'sorting', title: "Sorting" }
            ]
        });
    });

    $(document).on("click", ".edit", function() {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#name").val(row['name']);
            $("#company_name").val(row['company_name']);
            $("#message").val(row['message']);
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");
            scrollToDiv();
        }
    });

    $(document).ready(function() {
        $("#submit_form").on("submit", function(e) {
            e.preventDefault();
            var form = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('addTestimonial') }}',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        successMessage(response.message, true);
                        table.ajax.reload();
                    } else {
                        errorMessage(response.message);
                    }
                },
                failure: function(response) {
                    errorMessage(response.message);
                }
            });
        });
    });

    function deleteTestimonial(id) {
        if (id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This testimonial will be removed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('addTestimonial') }}',
                        data: {
                            id: id,
                            action: "delete",
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                successMessage(response.message);
                                table.ajax.reload()
                            } else {
                                errorMessage(response.message);
                            }
                        },
                        failure: function(response) {
                            errorMessage(response.message);
                        }
                    });
                }
            });
        } else {
            errorMessage("Something went wrong. Code 102");
        }
    }
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
