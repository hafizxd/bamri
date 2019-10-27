@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Driver</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="drivers/create">Add Driver</a>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">ID Number</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            @foreach($drivers as $driver)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->age }}</td>
                                    <td>{{ $driver->id_number }}</td>
                                    <td style="display: flex;">
                                        <a class="btn btn-warning" href="/drivers/{{ $driver->id }}/edit">Edit</a>
                                        <form id="delete-form" action="/drivers/{{ $driver->id }}" method="POST" class="ml-2">
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
