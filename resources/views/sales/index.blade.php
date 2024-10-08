@extends('master')
@section('title')
@endsection
@section('content')
    <h1>Tổng Doanh thu theo tháng</h1>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Tháng</th>
                    <th scope="col">Năm</th>
                    <th scope="col">Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $sales)
                    <tr class="">
                        <td scope="row">{{ $sales->month }}</td>
                        <td>{{ $sales->year }}</td>
                        <td>{{ $sales->total_sales }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
