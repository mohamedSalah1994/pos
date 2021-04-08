@extends('layouts.dashboard.app')
@section('title')
Clients
@endsection
@section('css')
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endsection

@section('content-header')
    <section class="content-header">
        <h1>
            {{ __('site.clients') }}

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> {{ __('site.dashboard') }}</a></li>
            <li class="active"><a href="#">{{ __('site.clients') }}</a></li>

        </ol>
    </section>
@endsection
@section('content')
<livewire:clients />
@endsection
@section('js')

    <script src="{{ asset('dashboard_files/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/dataTables.bootstrap.min.js') }}"></script>



@endsection

