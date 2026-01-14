@extends('layouts.webSite')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">Website Sitemap</h1>
    <p class="text-lg text-center text-gray-600 mb-10">
        Here's an organized list of all pages on our website.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Main Navigation Section --}}
        <div class="sitemap-section bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">Main Navigation</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline">Home</a></li>
                <li><a href="{{ route('aboutUs') }}" class="text-blue-600 hover:underline">About Us</a></li>
                <li><a href="{{ route('productPage') }}" class="text-blue-600 hover:underline">Our Services</a></li>
                <li><a href="{{ route('galleryPages') }}" class="text-blue-600 hover:underline">Gallery</a></li>
                <li><a href="{{ route('contactUs') }}" class="text-blue-600 hover:underline">Contact Us</a></li>
            </ul>
        </div>

        {{-- Products & Brands Section --}}
        {{-- <div class="sitemap-section bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-2xl font-semibold mb-4 text-purple-700">Products & Brands</h2> --}}
            {{-- <ul class="list-disc list-inside space-y-2 text-gray-700">
                @php
                    // Example: Fetch Brands if not already passed from a controller
                    // In a real application, you'd pass this via a controller or a View Composer
                    $brands = \App\Models\BrandPortfolio::where('status', 1)->get();
                @endphp
                @if(!empty($brands))
                    @foreach($brands as $brand)
                        <li><a href="{{ route('product-brand', ['slug' => $brand->slug]) }}" class="text-purple-600 hover:underline">{{ $brand->title }}</a></li>
                    @endforeach
                @else
                        <li><span class="text-gray-500">No brands found.</span></li>
                @endif
                {{-- Example: Add direct product category links if you have them --}}
                {{-- <li><a href="/products/category1" class="text-purple-600 hover:underline">Category 1</a></li> --}}
            {{-- </ul> --}} 
        {{-- </div> --}}

        {{-- Legal & Others Section --}}
        <div class="sitemap-section bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-2xl font-semibold mb-4 text-green-700">Legal & Others</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><a href="{{ route('termsConditions') }}" class="text-green-600 hover:underline">Terms & Conditions</a></li>
                <li><a href="{{ route('privacyPolicy') }}" class="text-green-600 hover:underline">Privacy Policy</a></li>
                {{-- Add any other important static pages here --}}
            </ul>
        </div>
    </div>
</div>
@endsection

<style>
    /* Custom styles for the sitemap page - simplified */
    .sitemap-section ul {
        padding-left: 1.5rem; /* Standard bullet point indent */
    }
    .sitemap-section ul li a {
        display: inline-block; /* Ensure link respects line-height */
        transition: color 0.2s ease-in-out; /* Smooth color transition on hover */
    }
    /* Remove custom bullet point and hover underline if desired for extreme simplicity */
    .sitemap-section ul li a::before,
    .sitemap-section ul li a::after {
        content: none !important; /* Force remove pseudo-elements */
    }
</style>
