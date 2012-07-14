@layout('admin.master')

@section('content')
<h1 class="page-header">Controls</h1>
<div class="well">
    <ul>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_user_roles') ?>">Manage User Roles</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_locations') ?>">Manage Locations</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_users') ?>">Manage Users</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_inventory_types') ?>">Manage Inventory Types</a></li>
        <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_locations') ?>">Manage Alloted Location</a></li>
    </ul>
</div>
@endsection