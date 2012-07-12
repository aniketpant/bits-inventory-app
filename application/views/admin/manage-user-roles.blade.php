@layout('admin.master')

@section('content')
<h1 class="page-header">Manage User Roles</h1>
<div class="well">
    <h3>Existing User Roles</h3>
    <?php
        if ($user_roles):
    ?>
        <ul>
    <?php
            foreach ($user_roles as $user_role):
    ?>
            <li><?php echo $user_role->role_name ?></li>
    <?php
            endforeach;
    ?>
        </ul>
    <?php
        else:
    ?>
        <p>
            No user roles exist!
        </p>
    <?php
        endif;
    ?>
</div>
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_user_roles'); ?>
    <div class="control-group <?php if($errors->has('user_role_name')) echo 'error'; ?>">
            <?php echo Form::label('user_role_name', 'New User Role', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::input('user_role_name', 'user_role_name', Input::old('user_role_name')) ?>
            </div>
    </div>
    <div class="control-group">
            <div class="controls">
                    <?php echo Form::submit('Add', array('class' => 'btn btn-success')) ?>
            </div>
    </div>
    <?php echo Form::close(); ?>
</div>
<?php
if($errors):
    foreach ($errors->all() as $error):
?>
<p class="alert alert-error"><?php echo $error; ?></p>
<?php
    endforeach;
endif; ?>
@endsection