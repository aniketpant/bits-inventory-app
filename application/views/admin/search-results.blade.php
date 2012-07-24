@section('search-results')
<h3>List of users</h3>
@forelse($users as $user)
    @if(Session::get('primary_uri') == 'admin/dashboard/controls/manage_alloted_locations')
    <a class="btn btn-inverse" rel="get_info" href="<?php echo url('admin/dashboard/controls/alloted_locations/' . $user->details->id); ?>">{{ $user->user_name }}</a>
    @elseif(Session::get('primary_uri') == 'admin/dashboard/controls/manage_alloted_inventory')
    <a class="btn btn-inverse" rel="get_info" href="<?php echo url('admin/dashboard/controls/user_roles/' . $user->details->id); ?>">{{ $user->user_name }}</a>
    @endif
@empty
<p class="alert alert-block alert-info">No users found.</p>
@endforelse        
@yield_section

@section('next-form')
<div id="next-result"></div>
@yield_section

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('a[rel="get_info"]').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#next-result').load(url, function() {
            });
        });
    });
</script>
@yield_section