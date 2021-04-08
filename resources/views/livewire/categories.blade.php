<div>
    <div>
        {{-- @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('message_delete'))
            <div class="alert alert-danger">
                {{ session('message_delete') }}
            </div>
        @endif --}}

        @if (session('success'))

            <script>
                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: "{{ session('success') }}",
                    timeout: 2000,
                    killer: true
                }).show();

            </script>
        @endif

    </div>

    @if ($show_table)




        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">

                        <h3 class="box-title">{{ __('site.categories') }}</h3>
                        <small>({{ \App\Models\Category::count() }})</small>

                    </div>
                    <div class="col-sm-4">
                        @if (auth()
        ->user()
        ->hasPermission('categories_create'))
                            <button wire:click="showformadd" class="btn btn-primary"><i class="fa fa-plus"></i>
                                {{ __('site.add') }}</button>
                        @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                {{ __('site.add') }}</a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending"
                                            style="width: 7%;">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 18%;">
                                            {{ __('site.category') }}
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 18%;">
                                            button
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 18%;">
                                            {{ __('site.action') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($categories as $category)
                                        <tr role="row" class="odd">
                                            <?php $i++; ?>
                                            <td class="sorting_1">{{ $i }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td> <button type="button"
                                                    wire:click="sortByCategory({{ $category->id }})"
                                                    class="btn btn-primary ">

                                                    {{ __('site.related_products') }}</button></td>
                                            <td>
                                                @if (auth()
        ->user()
        ->hasPermission('categories_update'))
                                                    <button type="button" wire:click="edit({{ $category->id }})"
                                                        class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                        {{ __('site.edit') }}</button>
                                                @else
                                                    <button type="button" class="btn btn-info btn-sm disabled"><i
                                                            class="fa fa-edit"></i>
                                                        {{ __('site.edit') }}</button>
                                                @endif

                                                @if (auth()
        ->user()
        ->hasPermission('categories_delete'))

                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal-danger{{ $category->id }}"
                                                        class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>
                                                        {{ __('site.delete') }}</button>

                                                @else
                                                    <button class="btn btn-danger btn-sm disabled"><i
                                                            class="fa fa-trash"></i>
                                                        {{ __('site.delete') }}</button>
                                                @endif

                                            </td>


                                        </tr>


                                        {{-- ------- delete modal -------- --}}

                                        <div class="modal fade in" id="modal-danger{{ $category->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">{{ __('site.delete') }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ __('site.confirm_delete') }}</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button"
                                                            wire:click="delete({{ $category->id }})"
                                                            data-dismiss="modal"
                                                            class="btn btn-danger">{{ __('site.delete') }}</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->

        </div>
    @elseif ($sorted_table)
        @include('livewire.products')
    @else
        @include('dashboard.categories.create')
    @endif
</div>
