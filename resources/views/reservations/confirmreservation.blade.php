@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="/css/styles.css">
@endpush

@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/images/card.jpg" width="100%" alt="Card image cap">
        <div class="card-block">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.name'): </strong> {{$reservation->name}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.email'): </strong> {{$reservation->email}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.phone'): </strong> {{$reservation->phone}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.date'): </strong> {{$reservation->reservation_date->format('d-m-Y')}}
                    </div>
                </div>
            </div>

            <h6 class="card-title"><small>@lang('global.availablehours')</small></h6>
            <form name="reservationForm" id="reservationForm" action="{{route('reservation.update', $reservation)}}" method="POST">
                @method('put')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12 input__button" {{ $errors->has('slot')? 'has error': ''}}>
                            @foreach($slots as $slot)
                                @if(in_array($slot, $slotsunavaliable))
                                    <div>
                                        <input type="radio" id="{{$loop->index}}" name="slot" value="{{$slot}}" disabled>
                                        <label for="{{$loop->index}}" class="slots unavailable">
                                          <p>{{$slot}}</p>
                                        </label>
                                    </div>
                                @else
                                    <div>
                                        <input type="radio" id="{{$loop->index}}" name="slot" value="{{$slot}}">
                                        <label for="{{$loop->index}}" class="slots">
                                          <p>{{$slot}}</p>
                                        </label>
                                    </div>

                                @endif
                            @endforeach
                    </div>
                    {!! $errors->first('slot', '<span class="help-block" style="color:red;">:message</span>')!!}
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="accept_politics" type="checkbox" id="accept_politics">
                        <label class="form-check-label" for="gridCheck">
                           <p>@lang('global.acceptprivacy')</p>
                        </label>
                    </div>
                    {!! $errors->first('accept_politics', '<span class="help-block" style="color:red;">:message</span>')!!}
                </div>
                <button type="submit" class="btn btn-primary" id="btncheck" disabled>@lang('global.book')</button>
                <a href="{{url('/')}}" class="btn btn-primary">@lang('global.back')</a>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/js/jquery.min.js"></script>
    <script>
        $("input:radio").change(function () {
            $('#accept_politics').change(function () {
                $('#btncheck').prop("disabled", !this.checked);
            });
        });
    </script>;

@endpush



