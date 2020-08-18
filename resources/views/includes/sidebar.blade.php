<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Start Bootstrap
            </a>
        </li>
        <li class="active">
            <a href="#Dispatches" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Dispatches</a>
            <ul class="collapse list-unstyled" id="Dispatches">
                <li>
                    <a href="{{ route('dispatch') }}">All Dispatch (Table Format)</a>
                </li>
                <li>
                    <a href="{{ route('grid') }}">All Dispatch (Grid Format)</a>
                </li>
                <li>
                    <a href="{{ route('dispatch.add.page') }}">Add Dispatch</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="#Drivers" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Drivers</a>
            <ul class="collapse list-unstyled" id="Drivers">
                <li>
                    <a href="{{ route('driver') }}">All Drivers</a>
                </li>
                <li>
                    <a href="{{ route('driver.add.page') }}">Add Driver</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="#Sources" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Sources</a>
            <ul class="collapse list-unstyled" id="Sources">
                <li>
                    <a href="{{ route('source') }}">All Source</a>
                </li>
                <li>
                    <a href="{{ route('source.add.page') }}">Add Source</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="#Destinations" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Destinations</a>
            <ul class="collapse list-unstyled" id="Destinations">
                <li>
                    <a href="{{ route('destination') }}">All Destination</a>
                </li>
                <li>
                    <a href="{{ route('destination.add.page') }}">Add Destination</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="#Transporters" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Transporters</a>
            <ul class="collapse list-unstyled" id="Transporters">
                <li>
                    <a href="{{ route('transporter') }} ">All Transporter</a>
                </li>
                <li>
                    <a href="{{ route('transporter.add.page') }}">Add Transporter</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="#Vehicles" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Vehicles</a>
            <ul class="collapse list-unstyled" id="Vehicles">
                <li>
                    <a href="{{ route('vehicle') }}">All Vehicle</a>
                </li>
                <li>
                    <a href="{{ route('vehicle.add.page') }}">Add Vehicle</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

@push('styles')
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
@endpush
<!-- /#wrapper -->
<!-- Menu Toggle Script -->