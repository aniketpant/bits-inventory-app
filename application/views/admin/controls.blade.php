@layout('admin.master')

@section('content')
<h1 class="page-header">Controls <small>Control panel for managing the data</small></h1>

<h3>Manage Masters</h3>
<ul>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_user_roles') ?>">Manage User Roles</a></li>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_locations') ?>">Manage Locations</a></li>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_inventory_types') ?>">Manage Inventory Types</a></li>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_users') ?>">Manage Users</a></li>
</ul>
<h3>Manage Allotments</h3>
<ul>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_locations') ?>">Manage Alloted Locations</a></li>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_inventory_types') ?>">Manage Alloted Inventory Types</a></li>
    <li><a href="<?php echo url('admin/dashboard/controls/manage_alloted_inventory') ?>">Manage Alloted Inventory</a></li>
</ul>

@endsection