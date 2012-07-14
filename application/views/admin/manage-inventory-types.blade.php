@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Locations</h1>
<div class="well">
    <h3>Existing Inventory Types</h3>
    <?php
        if ($inventory_types):
    ?>
        <ul>
    <?php
            foreach ($inventory_types as $type):
    ?>
            <li><?php echo $type->inventory_type_name ?></li>
    <?php
            endforeach;
    ?>
        </ul>
    <?php
        else:
    ?>
        <p>
            No inventory types exist!
        </p>
    <?php
        endif;
    ?>
</div>
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_inventory_types'); ?>
    <div class="control-group <?php if($errors->has('inventory_type_name')) echo 'error'; ?>">
            <?php echo Form::label('inventory_type_name', 'New Inventory Type', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::input('inventory_type_name', 'inventory_type_name', Input::old('inventory_type_name')) ?>
            </div>
    </div>
    <div class="control-group">
            <div class="controls">
                    <?php echo Form::submit('Add', array('class' => 'btn btn-success')) ?>
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