<div class="form-horizontal">
    <h3>Allot locations on basis of User Roles</h3>
    <?php echo Form::open('admin/dashboard/controls/manage_alloted_locations'); ?>
    <?php echo Form::hidden('user_details_id', $user->id); ?>
    
    @foreach ($user_roles as $user_role)
    <div class="control-group">
        <?php echo Form::label($user_role . '[]', $user_role, array('class' => 'control-label')) ?>
        <div class="controls">
            <?php echo Form::select($user_role . '[]', $locations, $user_role_locations[$user_role], array('class' => 'input-location', 'multiple')) ?>
        </div>
    </div>
    @endforeach
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('Save', array('class' => 'btn btn-success')) ?>
        </div>
    </div>
    <?php echo Form::close(); ?>
</div>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.input-location').select2();
    });
</script>
@yield_section