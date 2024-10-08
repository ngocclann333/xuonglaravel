@extends('master')
@section('title')
@endsection
@section('content')
    <h1>Tổng chi phí theo tháng</h1>
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
                @foreach ($data as $expense)
                    <tr class="">
                        <td scope="row">{{ $expense->month }}</td>
                        <td>{{ $expense->year }}</td>
                        <td>{{ $expense->total_expenses }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
