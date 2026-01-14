@extends('layouts.webSite')
@section('title', 'Report')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Report</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content report-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Krishidha Report</h2>
                {{-- <p class="text-center pb-3">From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels.</p> --}}
            </div>

                {{-- <h3 class="text-center report-title mb-3 mt-2">2021 - 2025</h3> --}}
                <div class="report-container midd-content">
                    <div class="footer_doc_link text-center">
                @if ($repots->isNotEmpty())
                @foreach ($repots as $ReportRow)
                    <a href="{{ url($ReportRow->file) }}"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports {{ $ReportRow->r_session}}</span></a>
               @endforeach
               @else
               <a href="/"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports 2020</span></a>
               <a href="/"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports 2021</span></a>
               <a href="/"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports 2022</span></a>
               <a href="/"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports 2023</span></a>
               <a href="/"><img src="assets/img/PDF_file_icon.png" height="" width="" class="img-fluid" alt="PDF"><span>PDF Reports 2024</span></a>

                @endif
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
