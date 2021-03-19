@extends('layouts.dashboard.app')
@section('title')
Products
@endsection


@section('content-header')
    <section class="content-header">
        <h1>
            {{ __('site.products') }}

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> {{ __('site.dashboard') }}</a></li>
            <li class="active"><a href="#">{{ __('site.products') }}</a></li>

        </ol>
    </section>
@endsection
@section('content')
<livewire:products />
@endsection
@section('js')
    <script src="{{ asset('dashboard_files/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/dataTables.bootstrap.min.js') }}"></script>

@endsection

