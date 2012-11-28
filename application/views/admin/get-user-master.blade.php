@if($users)
<table class="table">
    <thead>
    <th>User Name</th>
    <th>PSRN</th>
    <th>User Role</th>
    <th>Action</th>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
    <td>{{ $user->user_name }}</td>
    <td>{{ $user->details->psrn }}</td>
    <td>
        @foreach ($user->details->role as $user_role)
        <span class="badge badge-info">{{ $user_role->role_name }}</span>
        @endforeach
    </td>
    <td><a rel="edit" data-toggle="modal" href="#modal-<?php echo $user->id ?>" class="btn btn-info">Edit</a></td>
    </tr>
    @endforeach
</tbody>
</table>
@else
<p>No user roles exist!</p>
@endif

@foreach ($users as $user)
<?php
    $roles_user = $user->details->role;
    $roles[$user->details->id] = array();
    foreach ($roles_user as $role):
        array_push($roles[$user->details->id], $role->role_name);
    endforeach;
?>
<div class="modal hide fade" id="modal-<?php echo $user->id ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Update &ldquo;{{ $user->user_name }}&rdquo;</h3>
    </div>
    <div class="modal-body">
        <input type="hidden" name="inputId" value="<?php echo $user->details->id ?>">
        <div class="control-group">
            <label for="inputUserName">User Name</label>
            <input type="text" name="inputUserName" value="<?php echo $user->user_name ?>" disabled>
        </div>
        <div class="control-group">
            <label for="inputPSRN">PSRN</label>
            <input type="text" name="inputPSRN" value="<?php echo $user->details->psrn ?>" autofocus>
        </div>
        <div class="control-group">
            <label for="inputUserRoles">User Roles</label>
            <?php echo Form::select('inputUserRoles[' . $user->details->id . '][]', $user_roles, $roles[$user->details->id], array('class' => 'input', 'multiple')); ?>
        <div id="error_box"></div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <a rel="update" href="<?php echo url('admin/dashboard/controls/update_user') ?>" class="btn btn-primary">Update</a>
    </div>
</div>
@endforeach

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.input').select2();
        var urlModal = '';
        $('a[rel="edit"]').click(function() {
            urlModal = $(this).attr('href');
        });
        $('a[rel="update"]').click(function(e) {
            e.preventDefault();
            var urlUpdate = $(this).attr('href');
            var inputId = $(this).parent().parent().find('input[name="inputId"]').val();
            var inputPSRN = $(this).parent().parent().find('input[name="inputPSRN"]').val();
            var inputUserName = $(this).parent().parent().find('input[name="inputUserName"]').val();
            $.post(urlUpdate, { id: inputId, psrn: inputPSRN, user_name: inputUserName }, function() {
               $(urlModal).modal('hide');
               $('#ajax_box').load('<?php echo url('admin/dashboard/controls/user_master') ?>', function() {
               });
            });
        });
        $('select').change(function() {
            var inputUserRoles = $(this).val();
            var inputId = $(this).parent().parent().find('input[name="inputId"]').val();
            $(this).parent().find('#error_box').load('<?php echo url('admin/dashboard/controls/update_field') ?>', { field: 'user_role', id: inputId, user_roles: inputUserRoles }, function(data) {
            });
        });
    });
</script>
@yield_section