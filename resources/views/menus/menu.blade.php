@extends('layouts.layout')

@push('styles')
  <link rel="stylesheet" href="/css/menu/styles.css" />
  <link href="/css/menu/jquery.nice-number.css" rel="stylesheet">
@endpush


@section('content')

<section class="menu">
    <!-- title -->
    <div class="title">
      <h2>@lang('global.ourmenu')</h2>
      <div class="underline"></div>
    </div>
    <!-- filter buttons -->
    <div class="container">
        <div class="row mb-1">
            <div class="col-12 text-center">
                <div class="btn-container">
                    @foreach ($menus as $menu)
                    <button type="button" class="filter-btn mb-3" data-id="{{$menu->description}}">
                        {{$menu->description}}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- menu items -->
    <form name="dishesForm" id="dishesForm" action="{{route('order.store')}}" method="POST">
        @csrf
        <div class="section-center">
            @foreach ($dishes as $dish)
                    <article class="menu-item">
                        <input type="checkbox" class="checkbox-item" name="dishes_ids[]" value="{{$dish->id}}" id="dish-{{$loop->index}}">
                        @if ($dish->category_id == 1)
                            <label for="dish-{{$loop->index}}"><img src="/images/{{$dish->photo}}" alt="menu item" class="photo" />
                        @else
                            <label for="dish-{{$loop->index}}"><img src="/images/{{$dish->photo}}" alt="menu item" class="photo photo-drink" />
                        @endif
                        </label>
                            <div class="item-info">
                                <header>
                                    <h4>{{$dish->title}}</h4>
                                    <h4 class="price">{{$dish->price}}€</h4>
                                </header>
                                <p class="item-text">
                                    {{$dish->description}}
                                </p>
                                <div class="item-text nice-number show-hide">
                                    <input type="number" name="quantity[{{$dish->id}}]" min="1" max="10">
                                </div>
                            </div>
                    </article>
            @endforeach
        </div>
        <div class="container">
            <div class="row mt-1 mb-3">
                <div class="col-12 text-center">
                    {!! $errors->first('dishes_ids', '<span class="alert alert-danger" style="display:block;">:message</span>')!!}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-2 mb-1">
                <div class="col-12 text-center">
                    <div class="title">
                        <h2>Taula</h2>
                      </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-12 text-center">
                    <ul class="restaurant-tables">
                        @foreach ($tables as $table)
                        <li>
                            <input type="radio" name="table" value="{{$table->id}}" id="table-{{$loop->index}}">
                            <label for="table-{{$loop->index}}">
                                <img src="/images/table-restaurant_menu.png" alt="table-restaurant" class="photo-table" />
                                <p class="table-position">{{$table->id}}</p>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                    {!! $errors->first('table', '<span class="alert alert-danger" style="display:block;">:message</span>')!!}
                </div>
            </div>
            <input type="hidden" name="menu" value="{{$menu->id}}">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>@lang($message)</strong>
                </div>
            @endif
            <div class="row mt-3 mb-1">
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{url('/')}}"><button type="button" class="filter-btn mb-3">@lang('global.back')</button></a>
                    <button type="submit" class="filter-btn mb-3">@lang('global.order')</button>
                </div>
            </div>
        </div>
    </form>
  </section>



@endsection

@push('scripts')
    <script src="/js/app_reservation.js"></script>
    <script src="/js/jquery.nice-number.js"></script>

    <script>
        $(function(){
            $('input[type="number"]').niceNumber({
                // auto resize the number input
                autoSize: true,
                // the number of extra character
                autoSizeBuffer: 1,
                // custom button text
                buttonDecrement: '-',
                buttonIncrement: "+",
                // 'around', 'left', or 'right'
                buttonPosition: 'around'
            });

        });

        const nice_numbers = document.querySelectorAll(".nice-number");
        const checkbox_items = document.querySelectorAll(".checkbox-item");

        // nice_numbers.forEach(function (nice_number) {
        //     nice_number.style.display = "none";
        // });

        for (let i = 0; i < checkbox_items.length; i++) {
            checkbox_items[i].addEventListener("click", function() {
                if (checkbox_items[i].checked) {
                    nice_numbers[i].style.display = 'block';
                } else {
                     nice_numbers[i].style.display = 'none';
                }
            });
        }


    </script>

@endpush

