@layout('admin.master')

@section('content')
<h1 class="page-header">Manage User Roles</h1>

<div id="ajax_box"></div>

<?php echo Form::open('admin/dashboard/controls/manage_user_roles', 'POST', array('class' => 'form-horizontal well')); ?>
    <div class="control-group <?php if($errors->has('user_role_name')) echo 'error'; ?>">
            <?php echo Form::label('user_role_name', 'New User Role', array('class' => 'control-label')); ?>
            <div class="controls">
                    <?php echo Form::text('user_role_name', Input::old('user_role_name')) ?>
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
        $('#ajax_box').load('<?php echo url('admin/dashboard/controls/user_role_master') ?>', function() {
            
        });
    });
</script>
@endsection