@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Destination</h5>
                        <form method="POST" action="{{ route('vehicle.add') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="vehicle_name" class="col-md-4 col-form-label text-md-right">Vehicle Name</label>
                                <div class="col-md-6">
                                    <input id="vehicle_name" type="text" class="form-control @error('vehicle_name') is-invalid @enderror" name="vehicle_name" value="{{ old('vehicle_name') }}" autocomplete="vehicle_name" autofocus>
                                    <small class="form-text text-muted">Eg : Innova,Suzuki. </small>

                                    @error('vehicle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vehicle_no" class="col-md-4 col-form-label text-md-right">Vehicle No</label>
                                <div class="col-md-6">
                                    <input id="vehicle_no" type="text" class="form-control @error('vehicle_no') is-invalid @enderror" name="vehicle_no" value="{{ old('vehicle_no') }}" autocomplete="vehicle_no" autofocus>
                                    <small class="form-text text-muted">Eg : MH 99 AA 1111 or MH-99-AA-1111. </small>

                                    @error('vehicle_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vehicle_model" class="col-md-4 col-form-label text-md-right">Vehicle Company</label>
                                <div class="col-md-6">
                                    <input id="vehicle_model" type="text" class="form-control @error('vehicle_model') is-invalid @enderror" name="vehicle_model" value="{{ old('vehicle_model') }}" autocomplete="vehicle_model" autofocus>
                                    <small class="form-text text-muted">Eg : Toyota,Maruti. </small>
                                    @error('vehicle_model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Vehicle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection