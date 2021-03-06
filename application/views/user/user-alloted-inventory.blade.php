<h3>User's alloted inventory</h3>

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
    <th>
        <?php echo Form::text('inventory_data[' . $location->id . '][' . $inventory_type->id . ']', $inventory[$location->id][$inventory_type->id], array('class' => 'input-medium')) ?>
    </th>
    @endforeach
</tr>
@endforeach
<tbody>
</table>