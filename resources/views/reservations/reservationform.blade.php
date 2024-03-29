@extends('layouts.layout')

@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="/datepicker/datepicker.min.css">
    <link rel="stylesheet" href="/css/styles.css">
@endpush


@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/images/card.jpg" alt="Card image cap">
        <div class="card-block">
            <h5 class="card-title">@lang('global.perviousappointment')</h5>
            <form name="reservationForm" id="reservationForm" action="{{route('reservation.store')}}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6" {{ $errors->has('name')? 'has error': ''}}>
                        <label for="inputName">@lang('global.name')*</label>
                        <input name="name" type="text" class="form-control" id="inputName" value="{{old('name')}}">
                        {!! $errors->first('name', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                    <div class="form-group col-md-6" {{ $errors->has('email')? 'has error': ''}}>
                        <label for="inputEmail">@lang('global.email')*</label>
                        <input  name="email" type="email" class="form-control" id="inputEmail" value="{{old('email')}}">
                        {!! $errors->first('email', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>
                <div class="form-row" >
                    <div class="form-group col-md-6" {{ $errors->has('phone')? 'has error': ''}}>
                        <label for="inputPhone">@lang('global.phone')*</label>
                        <input name="phone" type="text" class="form-control" id="inputPhone" value="{{old('phone')}}">
                        {!! $errors->first('phone', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                    <div class="form-group col-md-6" {{ $errors->has('reservation_date')? 'has error': ''}}>
                        <label for="reservation_date">@lang('global.date')*</label>
                        <input name="reservation_date" type="text" class="form-control" id="reservation_date" value="{{old('reservation_date')}}">
                        {!! $errors->first('reservation_date', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('global.next')</button>
                <a href="{{url('/')}}" class="btn btn-primary">@lang('global.back')</a>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
<!-- date-range-picker -->
    <script src="/js/app_reservation.js"></script>
    <script src="/datepicker/datepicker.min.js"></script>
    <script src="/datepicker/datepicker.ca.min.js"></script>
    <script src="{{ asset('fullcalendar/moment/moment.min.js') }}"></script>

    <script>


        $(function () {
            var locale_lang = "{{app()->getLocale()}}";
            //Anual holidays
            var disableDates = ["1-1", "6-1","1-5","24-6","15-8","11-9","12-10","1-11","6-12","8-12","25-12","26-12"];

            //Unavailable days
            var unavailabledays = [
                @foreach($unavailabledays as $unavailableday)
                    moment('{{ $unavailableday->reservation_date}}').format('D-M'),
                @endforeach
            ];

            console.log(unavailabledays);

            //Date picker
            $('#reservation_date').datepicker({
                startDate: '+1d',
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight:true,
                language: locale_lang,
                daysOfWeekDisabled: [0],
                beforeShowDay: function(date){
                    dmy = date.getDate() + "-" + (date.getMonth() + 1);
                    if(disableDates.indexOf(dmy) != -1 || unavailabledays.indexOf(dmy) != -1){
                        return false;
                    }else{
                        return true;
                    }
                }
            })

        });
        </script>;

@endpush

