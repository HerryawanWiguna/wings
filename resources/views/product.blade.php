@extends('layouts.app')

@section('title', 'Product')

@push('inline_scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-add').on('click', function (e) {
                e.preventDefault();
                
                var id = $(this).data('id');

                console.log(id);

                $.ajax({
                    "url": 'transaction/add-product',
                    "type": 'POST',
                    "data": {
                        "id": id
                    },
                    "success": (result) => {
                        console.log(result);
                        if (result.status) {
                            var tempQuantity = parseInt($(this).parent().find('.quantity').text());
                            $(this).parent().find('.quantity').html(tempQuantity+1);
                        }
                    },
                    "error": (result) => {
                        console.log(result);
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h1 class="m-0 text-dark">Product</h1>
            </div>
            <div class="col-12 col-md-2">
                <a href="{{ route('cart') }}" class="btn btn-primary w-100"><i class="fas fa-shopping-cart"></i> Checkout</a>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        @foreach ($products as $product)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <img src="{{ asset('img/product/'.$product['prod_code'].'.jfif') }}" alt="{{ $product['name'] }}" class="img-fluid">
                            </div>
                            <div class="col-12 col-md-10">
                                <h6>{{ $product['name'] }}</h6>
                                @if ($product['discount'] != 0)
                                <small class="m-0"><del>{{ $product['price'] }}</del></small>
                                <p class="m-0">{{ $product['price_discount'] }}</p>
                                @else
                                <p class="m-0">{{ $product['price'] }}</p>
                                @endif
                                <p>Quantity: <span class="quantity">{{ $product['quantity'] }}</span></p>
                                <button class="btn btn-primary btn-small btn-add" data-id="{{ $product['prod_code'] }}"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection