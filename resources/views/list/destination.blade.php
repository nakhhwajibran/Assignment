@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Destination Details</h5>
                        <form class="form-inline" action="{{ route('destination') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="city" class="sr-only">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="City Name" value="{{ $city }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="state" class="sr-only">State</label>
                                <input type="text" class="form-control" name="state" id="state" placeholder="State Name" value="{{ $state }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="country" class="sr-only">Country</label>
                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="{{ $country }}">
                            </div>
                            <div class="form-group mx-sm-3 my-2 text-center">
                                <button type="submit" id="search" class="btn btn-primary mb-2 ">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table id='empTable' class='table table-bordered'>

                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
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
        $('#empTable').DataTable({
            'ajax': {
                'type': 'GET',
                'url': "{{ route('destination') }}",
                'data': {
                    "city": $('#city').val(),
                    "state": $('#state').val(),
                    "country": $('#country').val(),
                },
            },
            "searching": false,
            'columns': [{
                    data: 'city'
                },
                {
                    data: 'state'
                },
                {
                    data: 'country'
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