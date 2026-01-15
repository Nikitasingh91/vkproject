@extends('layouts.dashboardLayout')
@section('title', 'Manage Verticals')
@section('content')

    <x-content-div heading="Manage Verticals">
        <x-card-element header="Add Vertical">

            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">

                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                {{-- VERTICAL NAME --}}
                <x-input-with-label-element id="vertical_name" label="Vertical Name" name="vertical_name" type="text"
                    required="true">
                </x-input-with-label-element>

                {{-- VERTICAL IMAGE --}}
                <x-input-with-label-element id="vertical_image" label="Upload Image" name="vertical_image" type="file"
                    accept="image/*">
                </x-input-with-label-element>

                {{-- IMAGE PREVIEW --}}
                <div class="col-md-12 mb-3" id="imagePreview" style="display: none;">
                    <label><b>Current Image</b></label>
                    <div>
                        <img id="currentImage" src="" class="img-thumbnail" width="150">
                    </div>
                </div>

                {{-- MULTIPLE DIFFERENTIATORS --}}
                <div class="col-md-12 mb-3">
                    <label><b>Key Differentiators (Optional)</b></label>

                    <div id="diffContainer">
                        <div class="input-group mb-2 diff-item">
                            <input type="text" name="differentiators[]" class="form-control"
                                placeholder="Enter differentiator">
                            <button type="button" class="btn btn-success addDiff">+</button>
                        </div>
                    </div>
                </div>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Verticals List">
            <x-data-table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vertical Name</th>
                        <th>Image</th>
                        <th>Differentiators</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </x-data-table>
        </x-card-element>

    </x-content-div>
@endsection

@section('script')
    <script>
        let site_url = '{{ url('/') }}';
        let table = "";

        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('verticalsData') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'vertical_name',
                        name: 'vertical_name'
                    },
                    {
                        data: 'vertical_image_view',
                        name: 'vertical_image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'differentiators_view',
                        name: 'differentiators',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        // ADD MULTIPLE DIFFERENTIATORS
        $(document).on("click", ".addDiff", function() {
            $("#diffContainer").append(`
                <div class="input-group mb-2 diff-item">
                    <input type="text" name="differentiators[]" class="form-control" placeholder="Enter differentiator">
                    <button type="button" class="btn btn-danger removeDiff">-</button>
                </div>
            `);
        });

        $(document).on("click", ".removeDiff", function() {
            $(this).closest(".diff-item").remove();
        });

        // FORM SUBMIT
        $(document).on("submit", "#submitForm", function(e) {
            e.preventDefault();

            let form = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('saveVertical') }}",
                data: form,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        successMessage(response.message, "reload");
                    } else {
                        errorMessage(response.message);
                    }
                },
                error: function(xhr) {
                    errorMessage("An error occurred. Please try again.");
                }
            });
        });

        // EDIT BUTTON CLICK
        $(document).on("click", ".edit", function() {
            let rowData = $(this).data("row");

            // Decode base64 → JSON
            let decoded = JSON.parse(atob(rowData));

            // Reset form
            $("#submitForm")[0].reset();
            $("#imagePreview").hide();

            // Fill form
            $("#id").val(decoded.id);
            $("#action").val("update");
            $("#vertical_name").val(decoded.vertical_name);

            // Show current image if exists
            if (decoded.vertical_image) {
                $("#currentImage").attr("src", site_url + "/" + decoded.vertical_image);
                $("#imagePreview").show();
            }

            // Clear previous differentiators
            $("#diffContainer").html("");

            let list = decoded.differentiators ? JSON.parse(decoded.differentiators) : [];

            if (list.length > 0) {
                list.forEach((item, index) => {
                    if (item.trim() !== "") { // Only add non-empty items
                        let btnClass = index === 0 ? 'btn-success addDiff' : 'btn-danger removeDiff';
                        let btnText = index === 0 ? '+' : '-';

                        $("#diffContainer").append(`
                            <div class="input-group mb-2 diff-item">
                                <input type="text" name="differentiators[]" class="form-control" value="${item}" placeholder="Enter differentiator">
                                <button type="button" class="btn ${btnClass}">${btnText}</button>
                            </div>
                        `);
                    }
                });

                // If no items were added (all empty), add default
                if ($("#diffContainer").children().length === 0) {
                    $("#diffContainer").append(`
                        <div class="input-group mb-2 diff-item">
                            <input type="text" name="differentiators[]" class="form-control" placeholder="Enter differentiator">
                            <button type="button" class="btn btn-success addDiff">+</button>
                        </div>
                    `);
                }
            } else {
                $("#diffContainer").append(`
                    <div class="input-group mb-2 diff-item">
                        <input type="text" name="differentiators[]" class="form-control" placeholder="Enter differentiator">
                        <button type="button" class="btn btn-success addDiff">+</button>
                    </div>
                `);
            }

            // Scroll to form
            $('html, body').animate({
                scrollTop: $("#submitForm").offset().top - 100
            }, 500);
        });

        // ENABLE/DISABLE FUNCTIONS
        function Enable(id) {
            if (confirm("Are you sure you want to enable this vertical?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('saveVertical') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "action": "enable"
                    },
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, "reload");
                        } else {
                            errorMessage(response.message);
                        }
                    }
                });
            }
        }

        function Disable(id) {
            if (confirm("Are you sure you want to disable this vertical?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('saveVertical') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "action": "disable"
                    },
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, "reload");
                        } else {
                            errorMessage(response.message);
                        }
                    }
                });
            }
        }

        // Preview image before upload
        $("#vertical_image").on("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#currentImage").attr("src", e.target.result);
                    $("#imagePreview").show();
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    @include('Dashboard.include.dataTablesScript')
@endsection
