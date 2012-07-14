@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Users</h1>
<h3>Existing Users</h3>
<?php
    if ($users):
?>
    <table class="table table-bordered">
        <thead>
            <th>username</th>
            <th>psrn</th>
            <th>user role</th>
        </thead>
<?php
        foreach ($users as $user):
?>
        <tr>
            <td><?php echo $user->user_name ?></td>
            <td><?php echo $user->details->psrn ?></td>
            <td><?php echo $user->details->role[0]->role_name ?></td>
        </tr>
<?php
        endforeach;
?>
    </table>
<?php
    else:
?>
    <p>
        No users exist!
    </p>
<?php
    endif;
?>
    
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_users'); ?>
    <div class="control-group <?php if($errors->has('user_name')) echo 'error'; ?>">
            <?php echo Form::label('user_name', 'User Name', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::input('user_name', 'user_name', Input::old('user_name')) ?>
            </div>
    </div>
    <div class="control-group <?php if($errors->has('psrn')) echo 'error'; ?>">
            <?php echo Form::label('psrn', 'PSRN', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::input('psrn', 'psrn', Input::old('psrn')) ?>
            </div>
    </div>
    <div class="control-group <?php if($errors->has('user_role')) echo 'error'; ?>">
            <?php echo Form::label('user_role', 'User Role', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::select('user_role', $user_roles, Input::old('user_role')) ?>
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