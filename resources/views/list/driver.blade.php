@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Driver Details</h5>
                        <form class="form-inline" action="{{ route('driver') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">Driver Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Driver Name" value="{{ $name }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="phone" class="sr-only">Phone No</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone no" value="{{ $phone }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="address" class="sr-only">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ $address }}">
                            </div>
                            <div class="form-group mx-sm-3 my-2 text-center">
                                <button type="submit" id="search" class="btn btn-primary mb-2 ">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table id='driverTable' class='table table-bordered'>

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone-no</th>
                                    <th>Address</th>
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
        $('#driverTable').DataTable({
            'ajax': {
                'type': 'GET',
                'url': "{{ route('driver') }}",
                'data': {
                    "name": $('#name').val(),
                    "phone": $('#phone').val(),
                    "address": $('#address').val(),
                },
            },
            "searching": false,
            'columns': [{
                    data: 'name'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'address'
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