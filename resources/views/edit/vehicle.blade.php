@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Vehicle</h5>
                        <form method="POST" action="{{ route('vehicle.update',['id' => $data['id']]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="vehicle_name" class="col-md-4 col-form-label text-md-right">Vehicle Name</label>
                                <div class="col-md-6">
                                    <input id="vehicle_name" type="text" class="form-control @error('vehicle_name') is-invalid @enderror" name="vehicle_name" value="{{ old('vehicle_name', $data['vehicle_name']) }}" autocomplete="vehicle_name" autofocus>
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
                                    <input id="vehicle_no" type="text" class="form-control @error('vehicle_no') is-invalid @enderror" name="vehicle_no" value="{{ old('vehicle_no',$data['vehicle_no']) }}" autocomplete="vehicle_no" autofocus>
                                    @error('vehicle_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vehicle_comp" class="col-md-4 col-form-label text-md-right">Vehicle Company</label>
                                <div class="col-md-6">
                                    <input id="vehicle_comp" type="text" class="form-control @error('vehicle_model') is-invalid @enderror" name="vehicle_model" value="{{ old('vehicle_model',$data['vehicle_model']) }}" autocomplete="vehicle_comp" autofocus>
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
                                        Edit Vehicle
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