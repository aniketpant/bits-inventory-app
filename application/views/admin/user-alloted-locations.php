<div class="form-horizontal">
    <?php echo Form::open('admin/dashboard/controls/manage_alloted_locations'); ?>
    <?php
        foreach ($users as $user):
    ?>
    <div class="control-group">
            <?php echo Form::label($user->user_name . '[]', $user->user_name, array('class' => 'control-label')) ?>
            <div class="controls">
                    <?php echo Form::select($user->user_name . '[]', $locations, $user_location[$user->user_name], array('class' => 'input-location' , 'multiple')) ?>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.input-location').select2();
    });
</script>