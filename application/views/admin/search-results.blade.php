<?php
if ($users):
?>
<h3>List of users</h3>
<ul>
<?php
foreach($users as $user):
?>
    <li><a rel="user_get_locations" href="<?php echo url('admin/dashboard/controls/alloted_locations/' . $user->details->id); ?>"><?php echo $user->user_name; ?></a></li>
<?php
endforeach;
?>
</ul>
<?php
endif;
?>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('a[rel="user_get_locations"]').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#user-location-form').load(url, function() {
            });
        });
    });
</script>
@yield_section