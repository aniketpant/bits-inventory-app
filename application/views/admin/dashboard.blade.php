@layout('admin.master')

@section('content')
<div class="hero-unit">
    <h1>Dashboard</h1>
    <br/>
    <h3>Stats <small>Count of various attributes</small></h3>
    <dl class="dl-horizontal">
        <dt>Users</dt>
        <dd><?php echo $stats['users']; ?></dd>
        <dt>Locations</dt>
        <dd><?php echo $stats['locations']; ?></dd>
        <dt>Inventory Types</dt>
        <dd><?php echo $stats['inventory_types']; ?></dd>
    </dl>
</div>
@endsection