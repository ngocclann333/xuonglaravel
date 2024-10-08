@extends('master')
@section('title')
    <h1>Sale</h1>
@endsection
@section('content')
    <div class="table-responsive">
        <h1>Báo cáo tài chính</h1>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">month</th>
                    <th scope="col">year</th>
                    <th scope="col">total_sales</th>
                    <th scope="col">total_expanse </th>
                    <th scope="col">profit_before_tax</th>
                    <th scope="col">tax_amount</th>
                    <th scope="col">profit_after_tax</th>
                </tr>
            </thead>
            <tbody>
                    <tr class="">
                        <td scope="row">{{ $data->month}}</td>
                        <td>{{ $data->year}}</td>
                        <td>{{ $data->total_sales }}</td>
                        <td>{{ $data->total_expanse }}</td>
                        <td>{{ $data->profit_before_tax }}</td>
                        <td>{{ $data->tax_amount }}</td>
                        <td>{{ $data->profit_after_tax }}</td>
                    </tr>
                
            </tbody>
        </table>
    </div>
@endsection