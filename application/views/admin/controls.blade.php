@layout('admin.master')

@section('content')
<h1 class="page-header">Controls</h1>

<div class="btn-toolbar">
<a href="<?php echo url('admin/dashboard/controls/manage_user_roles') ?>" class="btn btn-large btn-primary">Manage User Roles</a>
<a href="<?php echo url('admin/dashboard/controls/manage_locations') ?>" class="btn btn-large btn-primary">Manage Locations</a>
<a href="<?php echo url('admin/dashboard/controls/manage_users') ?>" class="btn btn-large btn-primary">Manage Users</a>
<a href="<?php echo url('admin/dashboard/controls/manage_inventory_types') ?>" class="btn btn-large btn-primary">Manage Inventory Types</a>
<a href="<?php echo url('admin/dashboard/controls/manage_alloted_locations') ?>" class="btn btn-large btn-primary">Manage Alloted Location</a>
<a href="<?php echo url('admin/dashboard/controls/manage_alloted_inventory_types') ?>" class="btn btn-large btn-primary">Manage Alloted Inventory Types</a>
</div>

@endsection