@extends('layout')
@section('content')
    @include('/inc/popup')
    <div class="container bg-light vh-100">
        <div class="header p-2 ">
            <h3>Consult</h3>
        </div>
        <hr>
        <div class="bodyConsult">
            <div class="calendarConsult m-5 text-center">
                <h5 class="month"></h5>
                <hr>
                <div class="days row">
                </div>
            </div>
        </div>
    </div>
@endsection
