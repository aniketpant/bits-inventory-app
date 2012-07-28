@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Inventory Types</h1>

<div id="ajax_box"></div>

<?php echo Form::open('admin/dashboard/controls/manage_inventory_types', 'POST', array('class' => 'form-horizontal well')); ?>
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
        $('#ajax_box').load('<?php echo url('admin/dashboard/controls/inventory_type_master') ?>', function() {
            
        });
    });
</script>
@endsection