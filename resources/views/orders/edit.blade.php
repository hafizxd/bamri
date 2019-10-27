@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>

                <div class="card-body">
                    <form method="POST" action="/orders/{{ $order->id }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="contact_name" class="col-md-4 col-form-label text-md-right">Contact Name</label>

                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ $order->contact_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_phone" class="col-md-4 col-form-label text-md-right">Contact Phone</label>

                            <div class="col-md-6">
                                <input id="contact_phone" type="number" class="form-control" name="contact_phone" value="{{ $order->contact_phone }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rent_date" class="col-md-4 col-form-label text-md-right">Rent Date</label>

                            <div class="col-md-6">
                                <input id="rent_date" type="date" class="form-control" name="rent_date" onchange="fillBusDriver()" value="{{ $order->rent_date }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_days" class="col-md-4 col-form-label text-md-right">Total Days</label>

                            <div class="col-md-6">
                                <input id="total_days" type="number" min="1" class="form-control" name="total_days" onchange="fillBusDriver()" value="{{ $order->total_days }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bus" class="col-md-4 col-form-label text-md-right">Bus</label>

                            <div class="col-md-6">
                                <select name="bus" id="bus" class="form-control">
                                    <option value="{{ $order->bus->id }}">{{ $order->bus->brand }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="driver" class="col-md-4 col-form-label text-md-right">Driver</label>

                            <div class="col-md-6">
                                <select name="driver" id="driver" class="form-control">
                                    <option value="{{ $order->driver->id }}">{{ $order->driver->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
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

@section('script')
    <script>
        const fillBusDriver = () => {
            const rentDate = $('#rent_date').val();
            const totalDays = $('#total_days').val();
            if (rentDate && totalDays) {
                $('#bus').empty();
                $('#driver').empty();

                getBusDriver(rentDate, totalDays);
            }
        }

        const getBusDriver = (rentDate, totalDays) => {
            $.ajax({
                url: `/orders/getBus?rentDate=${rentDate}&totalDays=${totalDays}`,
                method: 'GET'
            }).done(res => {
                if (!res) $('#bus').append(`<option value="" disabled selected> No Bus Available </option>`);
                else {
                    res.forEach(bus => {
                        $('#bus').append(`<option value="${bus.id}"> ${bus.brand.toUpperCase()} </option>`);
                    });
                }
            });

            $.ajax({
                url: `/orders/getDriver?rentDate=${rentDate}&totalDays=${totalDays}`,
                method: 'GET'
            }).done(res => {
                if (!res) $('#bus').append(`<option value="" disabled selected> No Bus Available </option>`);
                else {
                     res.forEach(driver => {
                        $('#driver').append(`<option value="${driver.id}"> ${driver.name} </option>`);
                    });
                }
            });
        }
    </script>
@endsection
