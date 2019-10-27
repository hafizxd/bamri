@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bus</div>

                <div class="card-body">
                    <form method="POST" action="/buses/{{ $bus->id }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="plate_number" class="col-md-4 col-form-label text-md-right">Plate Number</label>

                            <div class="col-md-6">
                                <input id="plate_number" type="text" class="form-control" name="plate_number" value="{{ $bus->plate_number }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>

                            <div class="col-md-6">
                                <select name="brand" id="brand" class="form-control">
                                    <option value="mercedes" @if($bus->brand === 'mercedes') selected @endif>Mercedes</option>
                                    <option value="fuso" @if($bus->brand === 'fuso') selected @endif>Fuso</option>
                                    <option value="scania" @if($bus->brand === 'scania') selected @endif>Scania</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seat" class="col-md-4 col-form-label text-md-right">Seat</label>

                            <div class="col-md-6">
                                <input id="seat" type="number" min="1" class="form-control" name="seat" value="{{ $bus->seat }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price_per_day" class="col-md-4 col-form-label text-md-right">Price per Day</label>

                            <div class="col-md-6">
                                <input id="price_per_day" type="number" min="100000" class="form-control" name="price_per_day" value="{{ $bus->price_per_day }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
