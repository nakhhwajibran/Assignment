@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Dispatch</h5>
                        <form method="POST" action="{{ route('dispatch.update' ,['id' => $data['id']]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="delivery_no" class="col-md-4 col-form-label text-md-right">Delivery No</label>
                                <div class="col-md-6">
                                    <input id="delivery_no" type="number" class="form-control @error('delivery_no') is-invalid @enderror" name="delivery_no" value="{{ old('delivery_no',$data['delivery_no']) }}" readonly autocomplete="delivery_no" autofocus>
                                    <small class="form-text text-muted">Delivery no should be proper 10 digits no.</small>

                                    @error('delivery_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="shipment_no" class="col-md-4 col-form-label text-md-right">Shipment No</label>
                                <div class="col-md-6">
                                    <input id="shipment_noshipment_no" type="number" class="form-control @error('shipment_no') is-invalid @enderror" name="shipment_no" value="{{ old('shipment_no',$data['shipment_no']) }}" autocomplete="shipment_no" autofocus>
                                    @error('shipment_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="source_id" class="col-md-4 col-form-label text-md-right">Source</label>
                                <div class="col-md-6">
                                    <select name="source_id" id="source_id" class="form-control @error('source_id') is-invalid @enderror">
                                        <option value="">Please Select Source</option>
                                        @foreach($source as $s)
                                        <option value="{{ $s['id'] }}" @if( old('source_id', $data['source_id'] )==$s['id'] ) {{ "selected" }} @endif>{{ $s['city'].' , '. $s['state'] .' , '. $s['country']}}</option>
                                        @endforeach
                                    </select>
                                    @error('source_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="destination_id" class="col-md-4 col-form-label text-md-right">Destination</label>
                                <div class="col-md-6">
                                    <select name="destination_id" id="destination_id" class="form-control @error('source_id') is-invalid @enderror">
                                        <option value="">Please Select Destination</option>
                                        @foreach($destination as $d)
                                        <option value="{{ $d['id'] }}" @if( old('destination_id', $data['destination_id'] )==$d['id'] ) {{ "selected" }} @endif>{{ $d['city'].' , '. $d['state'] .' , '. $d['country']}}</option>
                                        @endforeach
                                    </select>
                                    @error('destination_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vehicle_id" class="col-md-4 col-form-label text-md-right">Vehicle No</label>
                                <div class="col-md-6">
                                    <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror">
                                        <option value="">Please Select Vehicle</option>
                                        @foreach($vehicle as $v)
                                        <option value="{{ $v['id'] }}" @if( old('vehicle_id' , $data['vehicle_id'] )==$v['id'] ) {{ "selected" }} @endif>{{ $v['vehicle_no'].' - '. $v['vehicle_model'] .' - '. $v['vehicle_name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="transporter_id" class="col-md-4 col-form-label text-md-right">Transporter</label>
                                <div class="col-md-6">
                                    <select name="transporter_id" id="transporter_id" class="form-control @error('transporter_id') is-invalid @enderror">
                                        <option value="">Please Select Transporter</option>
                                        @foreach($transporter as $t)
                                        <option value="{{ $t['id'] }}" @if( old('transporter_id', $data['transporter_id'])==$t['id'] ) {{ "selected" }} @endif>{{ $t['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('transporter_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address" autofocus>{{ old('address', $data['address']) }}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startDate" class="col-md-4 col-form-label text-md-right">Start Date</label>
                                <div class="col-md-6">
                                    <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{ old('startDate', $data['startDate']) }}" autocomplete="startDate" autofocus>

                                    @error('startDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="endDate" class="col-md-4 col-form-label text-md-right">End Date</label>
                                <div class="col-md-6">
                                    <input id="endDate" type="date" class="form-control @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate', $data['endDate']) }}" autocomplete="endDate" autofocus>
                                    <small class="form-text text-muted">End date should be greater than start date. </small>

                                    @error('endDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="driver_id" class="col-md-4 col-form-label text-md-right">Driver</label>
                                <div class="col-md-6">
                                    <select name="driver_id" id="driver_id" class="form-control @error('driver_id') is-invalid @enderror">
                                        <option value="">Please Select Driver</option>
                                        @foreach($driver as $dr)
                                        <option value="{{ $dr['id'] }}" @if( old('driver_id', $data['driver_id'] )==$dr['id'] ) {{ "selected" }} @endif> {{ $dr['name'].' , '. $dr['phone'] }} </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit Dispatch
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