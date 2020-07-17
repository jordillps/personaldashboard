@extends('layouts.app')


@push('styles')
  <link rel="stylesheet" href="/css/menu/restaurant/styles.css" />
@endpush

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                <a href="#">@lang('global.restaurant-tables')</a>
                </li>
                {{-- <li class="breadcrumb-item active">@lang('global.tables')</li> --}}
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                  @lang('global.orderdetail')
                </div>
                <div class="d-flex justify-content-around align-content-center my-3 font-weight-bold">
                    <div class="alert alert-success mb-0" role="alert">
                        Taula {{$table}}
                    </div>
                    <div class="alert alert-success mb-0" role="alert">
                        {{$menu->description}}
                    </div>
                    <div class="alert alert-success mb-0" role="alert">
                        {{$order->created_at->format('d-m-Y')}}
                    </div>
                </div>
                <div class="table-responsive mb-4">
                    <form role="form" method="POST" action="{{route('home.restaurant.order.update', $order)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        <table class="table">
                            <thead>
                                <tr>
                                <th colspan="2" class="text-center">Producte</th>
                                <th class="text-right">Quantitat</th>
                                <th class="text-right">Preu</th>
                                <th class="text-right">Total</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach ($order->lineOrders as $lineOrder)
                                        <tr>
                                           @if ($lineOrder->dish->category_id == 1)
                                             <td><img  class="photo" id="img-order" src="/images/{{$lineOrder->dish->photo}}" alt="{{$lineOrder->dish->description}}"></td>
                                           @else
                                             <td><img  class="photo photo-drink" id="img-order" src="/images/{{$lineOrder->dish->photo}}" alt="{{$lineOrder->dish->description}}"></td>
                                           @endif
                                            <td style="vertical-align: middle">{{$lineOrder->dish->title}}</td>
                                            <td class="text-right" style="vertical-align: middle"><input type="number" name="quantity[{{$lineOrder->dish->id}}]" min="1" max="10" value="{{old('quantity', $lineOrder->quantity)}}"></td>
                                            <td class="text-right" style="vertical-align: middle">{{number_format($lineOrder->dish->price, 2, ',', ' ')}} €</td>
                                            <td class="text-right" style="vertical-align: middle">{{number_format($lineOrder->subtotal, 2, ',', ' ')}} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th colspan="4" class="text-right">Subtotal</th>
                                    <th class="text-right">{{number_format($order->total_no_tax, 2, ',', ' ')}} €</th>
                                    </tr>
                                    <tr>
                                    <th colspan="4" class="text-right">IVA</th>
                                    <th class="text-right">{{number_format($order->tax, 2, ',', ' ')}} €</th>
                                    </tr>
                                    <tr>
                                    <th colspan="4" class="text-right">Total</th>
                                    <th class="text-right">{{number_format($order->total, 2, ',', ' ')}} €</th>
                                    </tr>
                                </tfoot>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary">@lang('global.updateorder')</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Add New Products --}}

            <button type="button" class="btn btn-primary mb-3" id="buttonAddProducts">@lang('global.addproducts')</button>

                <div class="col-lg-6 card mb-3" id="tableNewProducts">
                    <div class="card-header">
                        @lang('global.addproducts')
                    </div>
                    <div class="table-responsive mb-3">
                        <form role="form" method="POST" action="{{route('home.restaurant.order.addproducts', $order)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT')}}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Producte</th>
                                        <th class="text-right">Quantitat</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach ($dishes as $dish)
                                            <tr>
                                                @if ($dish->category_id == 1)
                                                    <td><img  class="photo" id="img-order" src="/images/{{$dish->photo}}" alt="{{$dish->description}}"></td>
                                                @else
                                                    <td><img  class="photo photo-drink" id="img-order" src="/images/{{$dish->photo}}" alt="{{$dish->description}}"></td>
                                                @endif
                                                <td style="vertical-align: middle">{{$dish->title}}</td>
                                                <td class="text-right" style="vertical-align: middle"><input type="number" name="quantity[{{$dish->id}}]" min="1" max="10"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            <div class="d-flex justify-content-around">
                                <button type="submit" class="btn btn-primary">@lang('global.addproduct')</button>
                            </div>
                        </form>
                    </div>
                </div>


        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $("#tableNewProducts").hide();

            $("#buttonAddProducts").click(function(){
                $("#tableNewProducts").show();
            });
        });

    </script>



@endpush

