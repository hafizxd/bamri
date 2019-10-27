@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bus</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="buses/create">Add Bus</a>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Plate Number</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Seat</th>
                                <th scope="col">Price per Day</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            @foreach($buses as $bus)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>{{ $bus->plate_number }}</td>
                                    <td>{{ $bus->brand }}</td>
                                    <td>{{ $bus->seat }}</td>
                                    <td>{{ $bus->price_per_day }}</td>
                                    <td style="display: flex;">
                                        <a class="btn btn-warning" href="/buses/{{ $bus->id }}/edit">Edit</a>
                                        <form id="delete-form" action="/buses/{{ $bus->id }}" method="POST" class="ml-2">
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
