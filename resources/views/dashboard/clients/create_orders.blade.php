<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

                </div><!-- end of box header -->

                <div class="box-body">

                    @foreach ($categories as $category)

                        <div class="panel-group">

                            <div class="panel panel-info">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse"
                                            href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                    </h4>
                                </div>

                                <div id="{{ str_replace(' ', '-', $category->name) }}"
                                    class="panel-collapse collapse">

                                    <div class="panel-body">

                                        @if ($category->products->count() > 0)

                                            <table class="table table-hover">
                                                <tr>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.stock')</th>
                                                    <th>@lang('site.price')</th>
                                                    <th>@lang('site.add')</th>
                                                </tr>

                                                @foreach ($category->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ number_format($product->sale_price, 2) }}</td>
                                                        <td>
                                                            <button type="button" id="product-{{ $product->id }}"
                                                                data-name="{{ $product->name }}"
                                                                data-id="{{ $product->id }}"
                                                                data-price="{{ $product->sale_price }}"
                                                                class="btn btn-success btn-sm add-product-btn">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table><!-- end of table -->

                                        @else
                                            <h5>@lang('site.no_records')</h5>
                                        @endif

                                    </div><!-- end of panel body -->

                                </div><!-- end of panel collapse -->

                            </div><!-- end of panel primary -->

                        </div><!-- end of panel group -->

                    @endforeach

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </div><!-- end of col -->

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title">@lang('site.orders')</h3>

                </div><!-- end of box header -->

                <div class="box-body">





                    @include('partials._errors')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('site.product')</th>
                                <th>@lang('site.quantity')</th>
                                <th>@lang('site.price')</th>
                            </tr>
                        </thead>

                        <tbody class="order-list">


                        </tbody>

                    </table><!-- end of table -->

                    <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                    <button wire:click = 'OrderAdd()' class="btn btn-primary btn-block " id="add-order-form-btn"><i
                            class="fa fa-plus"></i> @lang('site.add_order')</button>



                </div><!-- end of box body -->

            </div><!-- end of box -->

            {{-- @if ($client->orders->count() > 0) --}}

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                        <small></small>
                    </h3>

                </div><!-- end of box header -->

                <div class="box-body">

                    @foreach ($orders as $order)

                        <div class="panel-group">

                            <div class="panel panel-success">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse"
                                            href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                    </h4>
                                </div>

                                <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                    class="panel-collapse collapse">

                                    <div class="panel-body">

                                        <ul class="list-group">
                                            @foreach ($order->products as $product)
                                                <li class="list-group-item">{{ $product->name }}</li>
                                            @endforeach
                                        </ul>

                                    </div><!-- end of panel body -->

                                </div><!-- end of panel collapse -->

                            </div><!-- end of panel primary -->

                        </div><!-- end of panel group -->

                    @endforeach

                    {{-- {{ $orders->links() }} --}}

                </div><!-- end of box body -->

            </div><!-- end of box -->

            {{-- @endif --}}

        </div><!-- end of col -->

    </div><!-- end of row -->




</section><!-- end of content -->
<script>
    $(document).ready(function() {
        $('.add-product-btn').on('click', function() {
            var name = $(this).data('name');
            var id = $(this).data('id');
            var price = $.number($(this).data('price'), 2);
            console.log(name, id, price)
            $(this).removeClass('btn-success').addClass('disabled');

            var html =
                `<tr>
            <td>${name}</td>

            <td> <input type="number"  wire:model="quantity"  data-price="${price}"   class = "form-control product-quantity" min="1" value="1"> </td>
            <td class="product-price" wire:model="priceOrder">${price}</td>
            <td>
                <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button>
            </td>
            </tr>`
            $('.order-list').append(html);


            calculateTotal(); // to calculate total price

        }) //end of add product button

        $('body').on('click', '.remove-product-btn', function() {
            var id = $(this).data('id')
            $(this).closest('tr').remove();
            $('#product-' + id).removeClass('disabled').addClass('btn-success')


            calculateTotal(); // to calculate total price

        }) //end of remove product button

        $('body').on('keyup change', '.product-quantity', function() {
            var quantity = Number($(this).val()); //2
            var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
            var totalPrice = quantity * unitPrice;
            $(this).closest('tr').find('.product-price').html($.number(totalPrice, 2));

            calculateTotal(); // to calculate total price

        })//end of product quantity change


    }) //end of document ready

    function calculateTotal() {

        var price = 0;

        $('.order-list .product-price').each(function(index) {

            price += parseFloat($(this).html().replace(/,/g, ''));

        }); //end of product price

        $('.total-price').html($.number(price, 2));

        //check if price > 0
        if (price > 0) {

            $('#add-order-form-btn').removeClass('disabled')

        } else {

            $('#add-order-form-btn').addClass('disabled')

        } //end of else

    } //end of calculate total

</script>
