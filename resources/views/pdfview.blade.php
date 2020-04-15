@extends('layouts.app')

@push('styles')
    <style type="text/css">
        .bodyBody {
            margin: 10px;
            font-size: 1.20em;
        }
        .divLogo{
            align-content: left;
            clear: both; 
        }
        .divHeader {
            text-align: left;
            border: 1px solid;
        }
        .divSenderAddress {
            margin-top: 20px;
            align-content: left;
            text-align: left;
        }
        .divReceiverAddress {
            padding-top: 60px;
            align-content: left;
            text-align: left;
        }
        .divSubject {
            clear: both;
            font-weight: bold;
            padding-top: 40px;
        }
        .divAdios {
            float: left;
            padding-top: 50px;
        }
        
    </style>
    
@endpush

@section('content')

    <div class="bodyBody">
        <div class="divLogo">
            <img class="rounded-circle img-thumbnail" height="100" width="100" src="{{ public_path('images/avatar-icon.png') }}" alt="">
        </div>
        <div class="divSenderAddress">
            {{$sender_name}}<br/>
            {{$sender_address}}<br/>
            {{$sender_city}}<br/>    
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
        <div class="divReveiverAddress">
            {{$receiver_name}}<br/>
            {{$receiver_address}}<br/>
            {{$receiver_postalcode}}{{$receiver_city}} <br/>    
            <br/>
        </div>

        <div class="divSubject">
           {{$subject}}
        </div>

        <div class="divContents">
            <p>
                {{$salutation}}
            </p>

            <p>
                {{$content}}
            </p>
        </div>

        <div class="divAdios">
            Freundliche Grummel <br/>
            <!-- Space for signature. -->
            <br/>
            <br/>
            <br/>
            Evanildo Lopes do Almeida <br/>
            Hauswart Binningerstrasse 19/23 <br/>
            <br/>
            <br/>
            <br/>
            {{$date}}
        </div> 
    </div>

@endsection

