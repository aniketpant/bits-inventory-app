@layout('admin.master')

@section('content')
<h1 class="page-header">Controls</h1>

<div>
    <ul class="unstyled">
        <li><a href="<?php echo url('admin/dashboard/controls/manage_user_roles') ?>" class="btn btn-large btn-primary">Manage User Roles</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_locations') ?>" class="btn btn-large btn-primary">Manage Locations</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_users') ?>" class="btn btn-large btn-primary">Manage Users</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_inventory_types') ?>" class="btn btn-large btn-primary">Manage Inventory Types</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_locations') ?>" class="btn btn-large btn-primary">Manage Alloted Location</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_inventory_types') ?>" class="btn btn-large btn-primary">Manage Alloted Inventory Types</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_inventory') ?>" class="btn btn-large btn-primary">Manage Alloted Inventory</a></li>
    </ul>
</div>

@endsection