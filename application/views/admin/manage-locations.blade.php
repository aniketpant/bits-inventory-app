@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Locations</h1>
<div class="well">
    <h3>Existing Locations</h3>
    <?php
        if ($locations):
    ?>
        <ul>
    <?php
            foreach ($locations as $locations):
    ?>
            <li><?php echo $locations->location_name ?></li>
    <?php
            endforeach;
    ?>
        </ul>
    <?php
        else:
    ?>
        <p>
            No locations exist!
        </p>
    <?php
        endif;
    ?>
</div>
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_locations'); ?>
    <div class="control-group <?php if($errors->has('location_name')) echo 'error'; ?>">
            <?php echo Form::label('location_name', 'New Location', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::input('location_name', 'location_name', Input::old('location_name')) ?>
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