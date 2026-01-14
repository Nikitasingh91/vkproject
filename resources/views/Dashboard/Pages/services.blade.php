@extends('layouts.dashboardLayout')

@section('title', 'Manage Services')

@section('content')
<x-content-div heading="Manage Services">
    {{-- Service Form --}}
    <x-card-element header="Add / Edit Service">
        <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:;">
            <x-input type="hidden" name="id" id="id" value=""></x-input>
            <x-input type="hidden" name="action" id="action" value="insert"></x-input>

            {{-- Banner Image --}}
            <x-input-with-label-element 
                id="banner_image" 
                label="Service Banner Image" 
                name="banner_image" 
                type="file" 
                accept="image/*"
                required>
            </x-input-with-label-element>

            {{-- Multiple Gallery Images --}}
            <x-input-with-label-element 
                id="gallery_images" 
                label="Gallery Images" 
                name="gallery_images[]" 
                type="file" 
                accept="image/*" 
                multiple>
            </x-input-with-label-element>

            {{-- Service Name --}}
            <x-input-with-label-element 
                id="heading_top" 
                label="Service Name" 
                name="heading_top" 
                required>
            </x-input-with-label-element>

            {{-- Slug --}}
            <x-input-with-label-element 
                id="slug" 
                label="Service Slug (URL)" 
                name="slug" 
                placeholder="example: 3d-scanning" 
                required>
            </x-input-with-label-element>

            {{-- Short Description --}}
            <x-input-with-label-element 
                id="heading_middle" 
                label="Short Description" 
                name="heading_middle">
            </x-input-with-label-element>

            {{-- Long Description (WYSIWYG) --}}
            <x-text-area-with-label 
                id="long_description" 
                label="Detailed Description" 
                name="long_description" 
                class="wysiwyg-editor">
            </x-text-area-with-label>

            {{-- SEO Fields --}}
            <x-input-with-label-element 
                id="seo_title" 
                label="SEO Title" 
                name="seo_title">
            </x-input-with-label-element>

            <x-input-with-label-element 
                id="seo_description" 
                label="SEO Description" 
                name="seo_description">
            </x-input-with-label-element>

            <x-input-with-label-element 
                id="seo_keywords" 
                label="SEO Keywords (comma separated)" 
                name="seo_keywords">
            </x-input-with-label-element>

            {{-- Status --}}
            <x-select-with-label id="slide_status" name="slide_status" label="Service Status" required="true">
                <option value="live">Live</option>
                <option value="disabled">Disabled</option>
            </x-select-with-label>

            {{-- Sorting --}}
            <x-input-with-label-element 
                id="slide_sorting" 
                label="Service Sorting Order" 
                type="number"
                name="slide_sorting">
            </x-input-with-label-element>

            {{-- Buttons --}}
            <x-form-buttons></x-form-buttons>
        </x-form-element>
    </x-card-element>

    {{-- Data Table --}}
    <x-card-element header="Services List">
        <x-data-table></x-data-table>
    </x-card-element>
</x-content-div>
@endsection

@section('script')
<script type="text/javascript">
let site_url = '{{ url('/') }}';
let table = "";

$(function() {
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "scrollX": true,
        ajax: {
            url: "{{ route('servicesData') }}",
            type: 'POST',
            data: { '_token': '{{ csrf_token() }}' }
        },
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
            { data: '{{ \App\Models\ServicesModel::ID }}', visible: false },
            {
                data: '{{ \App\Models\ServicesModel::BANNER_IMAGE }}',
                render: function(data) {
                    return data ? `${data}` : '';
                },
                orderable: false, searchable: false, title: "Banner"
            },
            {
                data: '{{ \App\Models\ServicesModel::HEADING_TOP }}',
                title: 'Service Name'
            },
            { data: '{{ \App\Models\ServicesModel::SLUG }}', title: 'Slug' },
            { data: '{{ \App\Models\ServicesModel::SLIDE_STATUS }}', title: 'Status' },
            { data: '{{ \App\Models\ServicesModel::SLIDE_SORTING }}', title: 'Sorting' },
            { data: 'action', orderable: false, searchable: false, title: 'Action' },
        ],
        order: [[1, "desc"]]
    });
});

$(document).on("click", ".edit", function() {
    let row = $.parseJSON(atob($(this).data("row")));
    if (row['id']) {
        $("#id").val(row['id']);
        $("#banner_image").attr("required", false);
        $("#heading_top").val(row['heading_top']);
        $("#slug").val(row['slug']);
        $("#heading_middle").val(row['heading_middle']);
        $("#long_description").val(row['long_description']);
        $("#seo_title").val(row['seo_title']);
        $("#seo_description").val(row['seo_description']);
        $("#seo_keywords").val(row['seo_keywords']);
        $("#slide_status").val(row['slide_status']);
        $("#slide_sorting").val(row['slide_sorting']);
        $("#action").val("update");
        scrollToDiv();
    } else {
        errorMessage("Something went wrong. Code 101");
    }
});

$(document).ready(function() {
    $("#submitForm").on("submit", function() {
        var form = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route('servicesSaveSlide') }}',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status) {
                    successMessage(response.message, "reload");
                } else {
                    errorMessage(response.message);
                }
            }
        });
    });
});
</script>

{{-- Summernote or TinyMCE init --}}
<script>
$('.wysiwyg-editor').summernote({
    height: 200
});
</script>

@include('Dashboard.include.dataTablesScript')
@endsection
