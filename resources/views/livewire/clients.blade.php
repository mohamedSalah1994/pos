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
    @include('dashboard.clients.clients_table')

    @elseif($showOrdresForm)
        @include('dashboard.clients.create_orders')
    @else
        @include('dashboard.clients.create')
    @endif

</div>
