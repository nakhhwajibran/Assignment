@extends('includes.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dispatch Details</h5>
                    <form id="dispatchForm" class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="delivery_no" class="sr-only">Delivery No</label>
                            <input type="number" class="form-control" name="delivery_no" value="{{ $delivery_no }}" id="delivery_no" placeholder="Delivery No">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="shipment_no" class="sr-only">Shipment No</label>
                            <input type="number" class="form-control" value="{{ $shipment_no }}" name="shipment_no" id="shipment_no" placeholder="Shipment No">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="source" class="sr-only">Source</label>
                            <input type="text" class="form-control" value="{{ $source }}" name="source" id="source" placeholder="Source">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="destination" class="sr-only">Destination</label>
                            <input type="text" class="form-control" value="{{ $destination }}" name="destination" id="destination" placeholder="Destination">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="vehicle_no" class="sr-only">Vehicle No</label>
                            <input type="text" class="form-control" value="{{ $vehicle }}" name="vehicle_no" id="vehicle_no" placeholder="Vehicle No">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="transporter" class="sr-only">Transporter</label>
                            <input type="text" class="form-control" value="{{ $transporter }}" name="transporter" id="transporter" placeholder="Transporter">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="driver" class="sr-only">Driver</label>
                            <input type="text" class="form-control" value="{{ $driver }}" name="driver" id="driver" placeholder="Driver">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="start_date" class="px-1">Start Date</label>
                            <input type="date" class="form-control" value="{{ $startDate }}" name="start_date" id="start_date" placeholder="Start date">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="end_date" class="px-1">End Date</label>
                            <input type="date" class="form-control" value="{{ $endDate }}" name="end_date" id="end_date" placeholder="End date">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="hidden" value="{{ $take }}" name="take" id="take">
                            <input type="hidden" value="{{ $skip }}" name="skip" id="skip">
                            <input type="hidden" value="{{ $count }}" name="skip" id="count">
                        </div>
                        <div class="form-group mx-sm-3 my-2 text-center">
                            <input type="submit" class="btn btn-primary mb-2 " onclick="submitForm(event,'search')" value="Search">
                        </div>
                        <div class="form-group mx-sm-3 my-2 text-center">
                            <input type="submit" class="btn btn-primary mb-2 " onclick="submitForm(event,'export')" value="Export">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div id="dispatch-grid" style="display: contents;">
            @foreach($dispatch as $d)
            <div class="col-4 my-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Delivery No - <small class="text-muted">{{$d['delivery_no']}}</small></h5>
                        <h5>Shipment No - <small class="text-muted">{{$d['shipment_no']}}</small></h5>
                        <h5>Source - <small class="text-muted">{{ $d['source_city'].', '.$d['source_state'].', '.$d['source_country'] }}</small></h5>
                        <h5>Destination - <small class="text-muted">{{ $d['destination_city'].', '.$d['destination_state'].', '.$d['destination_country'] }}</small></h5>
                        <h5>Transporter No - <small class="text-muted">{{$d['transporter_name']}}</small></h5>
                        <h5>Address - <small class="text-muted">{{$d['address']}}</small></h5>
                        <h5>Vechicle - <small class="text-muted">{{ $d['vehicle_name'] .', '. $d['vehicle_no'] }}</small></h5>
                        <h5>Driver - <small class="text-muted">{{ $d['driver_name'] .', '. $d['driver_phone'] }}</small></h5>
                        <h5>Start Date - <small class="text-muted">{{$d['startDate']}}</small></h5>
                        <h5>End Date - <small class="text-muted">{{$d['endDate']}}</small></h5>
                        <div>
                            <a name="edit" href="{{ route('dispatch.update.page', ['id' => $d['id']]) }}" class="btn btn-primary btn-sm"> Edit </a>
                            <a name="delete" href="{{ route('dispatch.delete', ['id' => $d['id']]) }}" class="btn btn-primary btn-sm"> Delete </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <nav id="load-more">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a id="load-more-button" class="page-link btn">Load More</a>
            </li>
        </ul>
    </nav>
</div>

@endsection

@push('styles')
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .row>div[class*='col-'] {
        display: flex;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        var skip = parseInt($('#skip').val());
        var take = parseInt($('#take').val());
        var count = parseInt($('#count').val()) - 1;

        if (count <= take) {
            $('#load-more').hide();
        }

        function submitForm(e, action) {
            e.preventDefault();
            var form = document.getElementById('dispatchForm');
            if (action == 'search') {
                form.action = '{{ route("grid") }}';
            } else {
                form.action = '{{ route("exportCsv") }}';
            }
            form.submit();
        }

        $('#load-more-button').click(function() {
            $.ajax({
                'type': 'POST',
                'url': '{{ route("loadMore") }}',
                'data': {
                    "_token": "{{ csrf_token() }}",
                    "delivery_no": $('#delivery_no').val(),
                    "shipment_no": $('#shipment_no').val(),
                    "source": $('#source').val(),
                    "destination": $('#destination').val(),
                    "vehicle_no": $('#vehicle_no').val(),
                    "transporter": $('#transporter').val(),
                    "driver": $('#driver').val(),
                    "start_date": $('#start_date').val(),
                    "end_date": $('#end_date').val(),
                    "skip": skip + take,
                    "take": take
                },
                success: function(result) {
                    console.log(result);
                    var appends;
                    $(result).each(function(index, data) {
                        appends = '<div class="col-4 my-4"><div class="card"><div class="card-body">';
                        appends += '<h5>Delivery No - <small class="text-muted">' + data.delivery_no + '</small></h5>';
                        appends += '<h5>Shipment No -  <small class="text-muted">' + data.shipment_no + '</small></h5>';
                        appends += '<h5>Source - <small class="text-muted">' + data.source_city + ', ' + data.source_state + ', ' + data.source_country + '</small></h5>';
                        appends += '<h5>Destination - <small class="text-muted">' + data.destination_city + ', ' + data.destination_country + ', ' + data.destination_state + '</small></h5>';
                        appends += '<h5>Transporter No - <small class="text-muted">' + data.transporter_name + '</small></h5>';
                        appends += '<h5>Address - <small class="text-muted">' + data.address + '</small></h5>';
                        appends += '<h5>Vehicle - <small class="text-muted">' + data.vehicle_name + ', ' + data.vehicle_no + '</small></h5>';
                        appends += '<h5>Driver - <small class="text-muted">' + data.driver_name + ', ' + data.driver_phone + '</small></h5>';
                        appends += '<h5>Start Date - <small class="text-muted">' + data.startDate + '</small></h5>';
                        appends += '<h5>End Date - <small class="text-muted">' + data.endDate + '</small></h5>';
                        appends += '<h5>End Date - <small class="text-muted">' + data.endDate + '</small></h5>';
                        appends += '<div><a name="edit" href="/dispatch/edit/' + data.id + '" class="btn btn-primary btn-sm"> Edit </a>';
                        appends += '<a name="delete" href="/dispatch/delete/' + data.id + '" class="btn btn-primary btn-sm mx-1"> Delete </a></div>';
                    });

                    $('#dispatch-grid').append(appends);
                    skip = skip + take;
                    if (count <= skip) {
                        $('#load-more').hide();
                    }
                },
            });
        });
    });
</script>
@endpush