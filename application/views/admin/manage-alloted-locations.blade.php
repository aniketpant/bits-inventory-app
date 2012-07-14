@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Locations</h1>
<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_alloted_locations'); ?>
    <?php
        foreach ($users as $user):
    ?>
    <div class="control-group">
            <?php echo Form::label('user-' . $user->user_name . '[]', $user->user_name, array('class' => 'control-label')) ?>
            <div class="controls">
                    <?php echo Form::select('user-' . $user->user_name . '[]', $locations, Input::old('user-' . $user->user_name), array('class' => 'input-location' , 'multiple')) ?>
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
        $('.input-location').select2();
    });
</script>
@endsection