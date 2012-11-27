@if($user_roles)
<table class="table">
    <thead>
    <th>Role Name</th>
    <th>Action</th>
    </thead>
    <tbody>
    @foreach ($user_roles as $user_role)
    <tr>
    <td>{{ $user_role->role_name }}</td>
    <td><a rel="edit" data-toggle="modal" href="#modal-<?php echo $user_role->id ?>" class="btn btn-info">Edit</a></td>
    </tr>
    @endforeach
</tbody>
</table>
@else
<p>No user roles exist!</p>
@endif

@foreach ($user_roles as $user_role)
<div class="modal hide" id="modal-<?php echo $user_role->id ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Update &ldquo;{{ $user_role->role_name }}&rdquo;</h3>
    </div>
    <div class="modal-body">
        <label>New Value</label>
        <input type="hidden" name="inputId" value="<?php echo $user_role->id ?>">
        <input type="text" name="inputUpdate" value="<?php echo $user_role->role_name ?>" autofocus>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <a rel="update" href="<?php echo url('admin/dashboard/controls/update_master') ?>" class="btn btn-primary">Update</a>
    </div>
</div>
@endforeach

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var urlModal;
        $('a[rel="edit"]').click(function() {
            urlModal = $(this).attr('href');
            $(urlModal).modal();
        });
        $('a[rel="update"]').click(function(e) {
            e.preventDefault();
            var urlUpdate = $(this).attr('href');
            var inputId = $(this).parent().parent().find('input[name="inputId"]').val();
            var inputUpdate = $(this).parent().parent().find('input[name="inputUpdate"]').val();
            $.post(urlUpdate, { table: 'user_role_master', id: inputId, value: inputUpdate }, function() {
               $(urlModal).modal('hide');
               $('#ajax_box').load('<?php echo url('admin/dashboard/controls/user_roles_master') ?>', function() {
            
               });
            });
        });
    });
</script>
@yield_section