<h3>Inventory you have been alloted</h3>

<table class="table table-bordered table-striped">
<thead>
<th>Location</th>
@foreach($user_inventory_types as $inventory_type)
<th>
    {{ $inventory_type->inventory_type_name }}
</th>
@endforeach
</thead>
<tbody>
@foreach($user_locations as $location)
<tr>
    <td>{{ $location->location_name }}</td>
    @foreach($user_inventory_types as $inventory_type)
    <td>
        {{ $inventory[$location->pivot->id][$inventory_type->id] }}
    </td>
    @endforeach
</tr>
@endforeach
<tbody>
</table>