@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Locations</h1>

<div id="ajax_box"></div>

<?php echo Form::open('admin/dashboard/controls/manage_locations', 'POST', array('class' => 'form-horizontal well')); ?>
<div class="control-group <?php if($errors->has('location_name')) echo 'error'; ?>">
        <?php echo Form::label('location_name', 'New Location', array('class' => 'control-label')); ?>
        <div class="controls">
                <?php echo Form::text('location_name', Input::old('location_name')) ?>
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
        $('#ajax_box').load('<?php echo url('admin/dashboard/controls/location_master') ?>', function() {
            
        });
    });
</script>
@endsection