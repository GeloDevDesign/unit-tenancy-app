@extends('layouts.app')

@section('banner')
    <x-banner :current-page="'Create User'"></x-banner>
@endsection

@section('styles')
    <style>
        .file-thumbnail-footer {
            display: none;
        }

        .file-preview {
            width: 45% !important;
        }
    </style>
@endsection

@section('content')
    <x-card :heading="'Edit Property Form'">
        @include('property-manager.form', [
            'property' => $property,
            'action' => route('property.update', ['property' => $property]),
        ])

    </x-card>
@endsection


@section('scripts')
    <script src="{{ asset('limitless/js/vendor/forms/inputs/passy.js') }}"></script>
    <script src="{{ asset('limitless/demo/pages/form_controls_extended.js') }}"></script>

    {{-- <script src="{{ asset('limitless/js/vendor/uploaders/fileinput/fileinput.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('limitless/demo/pages/uploader_bootstrap.js') }}"></script> --}}

    <script src="{{ asset('limitless/js/vendor/media/cropper.min.js') }}"></script>
    {{-- <script src="{{ asset('limitless/demo/pages/extension_image_cropper.js') }}"></script> --}}

    <script></script>
@endsection
