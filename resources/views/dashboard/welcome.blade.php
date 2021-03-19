@extends('layouts.dashboard.app')
@section('title')
Home
@endsection
@section('content-header')
<section class="content-header">
    <h1>{{ __('site.dashboard') }}</h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> {{ __('site.dashboard') }}</a></li>

    </ol>
  </section>
@endsection
@section('content')
<h1>welcome</h1>


@endsection


