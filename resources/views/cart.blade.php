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

            $('.btn-confirm').on('click', function (e) {
                e.preventDefault();
                
                var id = $(this).data('id');

                console.log(id);

                $.ajax({
                    "url": 'checkout',
                    "type": 'POST',
                    "data": {
                        "id": id
                    },
                    "success": (result) => {
                        console.log(result);
                        if (result) location.reload();
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
            <div class="col-12">
                <h1 class="m-0 text-dark">Cart</h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (!is_null($products))
                @foreach($products as $product)
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <img src="{{ asset('img/product/'.$product['prod_code'].'.jfif') }}" alt="{{ $product['product']['name'] }}" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-10">
                                    <h6>{{ $product['product']['name'] }}</h6>
                                    <p class="m-0">Quantity: {{ $product['quantity'].' '.strtoupper($product['product']['unit']) }}</p>
                                    <p>Sub Total: {{ $product['sub_total'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12"><p>Cart is Empty</p></div>
            @endif
            <div class="col-12 text-center">
                <h3>Total: {{ $total }}</h3>
                @if (!is_null($products))
                <button class="btn btn-primary btn-small btn-confirm" data-id="{{ $doc_number }}"><i class="fas fa-check"></i> Confirm</button>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection