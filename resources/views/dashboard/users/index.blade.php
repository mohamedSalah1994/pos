@extends('layouts.dashboard.app')
@section('title')
Users
@endsection
@section('content-header')
    <section class="content-header">
        <h1>
            {{ __('site.users') }}

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> {{ __('site.dashboard') }}</a></li>
            <li class="active"><a href="#">{{ __('site.users') }}</a></li>

        </ol>
    </section>
@endsection
@section('content')



    <div class="box">
        <div class="box-header">
           <div class="row">
               <div class="col-sm-8">

                   <h3 class="box-title">{{ __('site.users') }}</h3>
                   <small>({{ \App\Models\User::whereRoleIs('admin')->count() }})</small>


               </div>
               <div class="col-sm-4">
                @if (auth()
               ->user()
               ->hasPermission('users_create'))
                               <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                   {{ __('site.add') }}</a>
                           @else
                               <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                   {{ __('site.add') }}</a>
                           @endif
               </div>

           </div>
        </div>
        <!-- /.box-header -->
        @if ($users->count() > 0)
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 7%;">#
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 18%;">
                                        {{ __('site.first_name') }}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" style="width: 18%;">
                                        {{ __('site.last_name') }}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 25%;">
                                        {{ __('site.email') }}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 10%;">
                                    {{ __('site.image') }}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" style="width: 105px;">CSS
                                        {{ __('site.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($users as $user)
                                <tr role="row" class="odd">
                                    <?php $i++; ?>
                                    <td class="sorting_1">{{ $i }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{ $user->image_path }}" style="width: 40px ; height:30px"></td>
                                    <td>
                                        @if (auth()
                    ->user()
                    ->hasPermission('users_update'))
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i> {{ __('site.edit') }}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                                {{ __('site.edit') }}</a>
                                        @endif

                                        @if (auth()
                    ->user()
                    ->hasPermission('users_delete'))
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                        class="fa fa-trash"></i>
                                                    {{ __('site.delete') }}</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                                {{ __('site.delete') }}</button>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
        @else
        <h2>{{ __('site.no_data_found') }}</h2>
    @endif
    </div>

@endsection
@section('js')
    <script src="{{ asset('dashboard_files/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/dataTables.bootstrap.min.js') }}"></script>

@endsection







