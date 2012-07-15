@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Alloted Inventory Types</h1>
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_alloted_inventory_types'); ?>
    <?php
        foreach ($user_roles as $user_role):
    ?>
    <div class="control-group">
            <?php echo Form::label($user_role->role_name . '[]', $user_role->role_name, array('class' => 'control-label')) ?>
            <div class="controls">
                    <?php echo Form::select($user_role->role_name . '[]', $inventory_types, $user_role_inventory_types[$user_role->role_name], array('class' => 'input-inventory_type' , 'multiple')) ?>
            </div>
    </div>
    <?php
        endforeach;
    ?>
    <div class="control-group">
            <div class="controls">
                    <?php echo Form::submit('Save', array('class' => 'btn btn-success')) ?>
            </div>
    </div>
    <?php echo Form::close(); ?>
</div>
@endsection

@section('errors')
<?php
if($errors):
    foreach ($errors->all() as $error):
?>
<p class="alert alert-error"><?php echo $error; ?></p>
<?php
    endforeach;
endif;
?>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.input-inventory_type').select2();
    });
</script>
@endsection