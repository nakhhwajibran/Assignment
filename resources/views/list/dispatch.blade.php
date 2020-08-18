@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
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
                            <div class="form-group mx-sm-3 my-2 text-center">
                                <input type="submit" class="btn btn-primary mb-2 " onclick="submitForm(event,'search')" value="Search">
                            </div>
                            <div class="form-group mx-sm-3 my-2 text-center">
                                <input type="submit" class="btn btn-primary mb-2 " onclick="submitForm(event,'export')" value="Export">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Dispatch Details</h5>
                        <table id='dispatchTable' class='table table-bordered'>

                            <thead>
                                <tr>
                                    <th>Delivery No</th>
                                    <th>Shipment No</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Transporter</th>
                                    <th>Vechicle No</th>
                                    <th>Driver Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dispatchTable').DataTable({
            'ajax': {
                'type': 'GET',
                'url': "{{ route('dispatch') }}",
                'data': {
                    "delivery_no": $('#delivery_no').val(),
                    "shipment_no": $('#shipment_no').val(),
                    "source": $('#source').val(),
                    "destination": $('#destination').val(),
                    "vehicle_no": $('#vehicle_no').val(),
                    "transporter": $('#transporter').val(),
                    "driver": $('#driver').val(),
                    "start_date": $('#start_date').val(),
                    "end_date": $('#end_date').val(),
                },
            },
            'columns': [{
                    data: 'delivery_no'
                },
                {
                    data: 'shipment_no'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.source_city + ', ' + data.source_state + ', ' + data.source_country;
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.destination_city + ', ' + data.destination_state + ', ' + data.destination_country;
                    },
                },
                {
                    data: 'transporter_name'
                },
                {
                    data: 'vehicle_no',
                },
                {
                    data: 'driver_name'
                },
                {
                    data: 'startDate'
                },
                {
                    data: 'endDate'
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false
                }
            ],
            "searching": false
        });
    });

    function submitForm(e, action) {
        e.preventDefault();
        var form = document.getElementById('dispatchForm');
        if (action == 'search') {
            form.action = '{{ route("dispatch") }}';
        } else {
            form.action = '{{ route("exportCsv") }}';
        }
        form.submit();
    }
</script>
@endpush