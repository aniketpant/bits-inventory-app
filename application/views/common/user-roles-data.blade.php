<h3>Roles the user has been authorized</h3>
@forelse ($roles as $role)
    @foreach ($role->details as $row)
        <a class="btn" rel="get_location_data" href="<?php echo url('common/alloted_inventory/' . $row->id . '/' . $role->id . '/' . $row->pivot->id); ?>">{{ $role->role_name }}</a>
    @endforeach
@empty
<p class="alert alert-block alert-success">No user roles authorized.</p>

<div id="next-form"></div>
@endforelse

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('a[rel="get_location_data"]').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#next-form').load(url, { user_type: '<?php echo Session::get('user_type') ?>' }, function() {
                
            });
        });
    });
</script>
@yield_section