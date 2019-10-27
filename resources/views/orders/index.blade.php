@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="/orders/create">Add Order</a>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bus Brand</th>
                                <th scope="col">Driver Name</th>
                                <th scope="col">Contact Name</th>
                                <th scope="col">Contact Phone</th>
                                <th scope="col">Rent Date</th>
                                <th scope="col">Total Days</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            @foreach($orders as $order)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>{{ $order->bus->brand }}</td>
                                    <td>{{ $order->driver->name }}</td>
                                    <td>{{ $order->contact_name }}</td>
                                    <td>{{ $order->contact_phone }}</td>
                                    <td>{{ $order->rent_date }}</td>
                                    <td>{{ $order->total_days }}</td>
                                    <td style="display: flex;">
                                        <a class="btn btn-warning" href="/orders/{{ $order->id }}/edit">Edit</a>
                                        <form id="delete-form" action="/orders/{{ $order->id }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
