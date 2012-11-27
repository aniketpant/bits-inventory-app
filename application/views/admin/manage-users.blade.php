@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Users</h1>

<div id="ajax_box"></div>
    
<?php echo Form::open('admin/dashboard/controls/manage_users', 'POST', array('class' => 'form-horizontal well')); ?>
<div class="control-group <?php if($errors->has('user_name')) echo 'error'; ?>">
        <?php echo Form::label('user_name', 'User Name', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo Form::text('user_name', Input::old('user_name')) ?>
        </div>
</div>
<div class="control-group <?php if($errors->has('psrn')) echo 'error'; ?>">
        <?php echo Form::label('psrn', 'PSRN', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo Form::text('psrn', Input::old('psrn')) ?>
        </div>
</div>
<div class="control-group <?php if($errors->has('user_roles')) echo 'error'; ?>">
        <?php echo Form::label('user_roles', 'User Roles', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo Form::select('user_roles[]', $user_roles, Input::old('user_role'), array('class' => 'input', 'multiple')) ?>
        </div>
</div>
<div class="control-group">
        <div class="controls">
                <?php echo Form::submit('Add', array('class' => 'btn btn-success')) ?>
        </div>
</div>
<?php echo Form::close(); ?>
@endsection

@section('errors')
@if($errors)
@foreach ($errors->all() as $error)
    <p class="alert alert-error"><?php echo $error; ?></p>
@endforeach
@endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajax_box').load('<?php echo url('admin/dashboard/controls/user_master') ?>', function() {
            
        });
    });
</script>
@endsection