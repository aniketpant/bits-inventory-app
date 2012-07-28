@layout('admin.master')

@section('content')
<h1>Dashboard <small>The admin dashboard</small></h1>

<h3>Stats <small>Count of various attributes</small></h3>
<table class="table table-condensed">
    <thead>
    <th>Attribute</th>
    <th>Count</th>
    </thead>
    <tbody>
        <tr>
            <td>Users</td>
            <td>{{ $stats['users'] }}</td>
        </tr>
        <tr>
            <td>User Roles</td>
            <td>{{ $stats['user_roles'] }}</td>
        </tr>
        <tr>
            <td>Locations</td>
            <td>{{ $stats['locations'] }}</td>
        </tr>
        <tr>
            <td>Inventory Types</td>
            <td>{{ $stats['inventory_types'] }}</td>
        </tr>
    </tbody>
</table>
@endsection