@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle Details</h5>
                        <form class="form-inline" action="{{ route('vehicle') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="vehicle_name" class="sr-only">Vehicle Name</label>
                                <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" placeholder="Vehicle Name" value="{{ $vehicle_name }}">
                            </div>

                            <div class="form-group mx-sm-3 ">
                                <div>
                                    <label for="vehicle_no" class="sr-only">Vehicle Number</label>
                                    <input type="text" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="Vehicle Number" value="{{ $vehicle_no }}">
                                    <small class="form-text text-muted">Eg : MH 99 AA 1111 or MH-99-AA-1111. </small>
                                </div>

                            </div>


                            <div class="form-group mx-sm-3 mb-2">
                                <label for="vehicle_model" class="sr-only">Vehicle Model</label>
                                <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Vehicle Model" value="{{ $vehicle_model }}">
                            </div>

                            <div class="form-group mx-sm-3 my-2 text-center">
                                <button type="submit" id="search" class="btn btn-primary mb-2 ">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table id='transporterTable' class='table table-bordered'>

                            <thead>
                                <tr>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle No</th>
                                    <th>Vehicle Model</th>
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
        $('#transporterTable').DataTable({
            'ajax': {
                'type': 'GET',
                'url': "{{ route('vehicle') }}",
                'data': {
                    "vehicle_name": $('#vehicle_name').val(),
                    "vehicle_no": $('#vehicle_no').val(),
                    "vehicle_model": $('#vehicle_model').val(),
                },
            },
            "searching": false,
            'columns': [{
                    data: 'vehicle_name'
                },
                {
                    data: 'vehicle_no'
                },
                {
                    data: 'vehicle_model'
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false
                }
            ]
        });

        $('del').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('jibran');
        })
    });
</script>
@endpush