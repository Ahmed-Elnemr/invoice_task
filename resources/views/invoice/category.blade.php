@extends('layouts.master')

@section('title')
    categories
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h3 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">  Categories
                    <hr>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
    @livewire('invoice.category-livewire')
@endsection
{{-- Script --}}
@section('script')
    <script>
        window.addEventListener('close-modal', event => {

            $('#catModal').modal('hide');
            $('#updateCatModal').modal('hide');
            $('#deleteCatModal').modal('hide');
        })
    </script>
@endsection
