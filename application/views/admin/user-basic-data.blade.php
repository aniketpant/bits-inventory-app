@if ($locations)
<h3>Locations the user has been alloted</h3>
<ul>
@foreach ($locations as $location)
    <li>{{ $location->location_name }}</li>
@endforeach
</ul>
@endif
@if ($roles)
<h3>Roles the user has been authorized</h3>
<ul>
@foreach ($roles as $role)
    <li>{{ $role->role_name }}</li>
@endforeach
</ul>
@endif