@layout('admin.master')

@section('content')
<h1 class="page-header">Administrator Login <small>Please sign in with your administrator credentials</small></h1>
<div class="well form-horizontal">
        <?php echo Form::open('admin/login'); ?>
        <div class="control-group <?php if($errors->has('username')) echo 'error'; ?>">
                <?php echo Form::label('username', 'Username', array('class' => 'control-label')); ?>
                <div class="controls">
                        <?php echo Form::input('username', 'username', Input::old('username')) ?>
                </div>
        </div>
        <div class="control-group <?php if($errors->has('password')) echo 'error'; ?>">
                <?php echo Form::label('password', 'Password', array('class' => 'control-label')); ?>
                <div class="controls">
                        <?php echo Form::password('password') ?>
                </div>
        </div>
        <div class="control-group">
                <div class="controls">
                        <?php echo Form::submit('Login', array('class' => 'btn btn-success')) ?>
                </div>
        </div>
</div>
<?php
if($errors):
    foreach ($errors->all() as $error) {
?>
<p class="alert alert-error"><?php echo $error; ?></p>
<?php
    }
endif; ?>
@endsection