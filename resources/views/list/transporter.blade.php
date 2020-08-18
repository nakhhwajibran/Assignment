@extends('includes.main')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transporter Details</h5>
                        <form class="form-inline" action="{{ route('transporter') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $name }}">
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
                                    <th>Name</th>
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
                'url': "{{ route('transporter') }}",
                'data': {
                    "name": $('#name').val(),
                },
            },
            "searching": false,
            'columns': [{
                    data: 'name'
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