@extends('layout')
@section('content')
    @guest
        <div class="container text-center">
            <h4>SESSION ERROR</h4>
        </div>
    @else
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <div class="container py-5">
            <table class="mx-auto" id="showAppointments">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Interval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>
                                {{ $appointment['date'] }}
                            </td>
                            <td>
                                {{ $appointment['name'] }}
                            </td>
                            <td>
                                {{ $appointment['email'] }}
                            </td>
                            <td>
                                {{ $appointment['interval'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endguest
@endsection
