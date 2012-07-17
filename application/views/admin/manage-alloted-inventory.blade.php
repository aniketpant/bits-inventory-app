@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Alloted Inventory</h1>

<?php
if ($users) {
?>
<ul id="user-list" class="unstyled">
<?php
    foreach($users as $user):
?>
    <li><a href="<?php echo url('admin/dashboard/controls/user_locations/' . $user->details->id) ?>"><?php echo $user->user_name ?></a></li>
<?php
    endforeach;
?>
</ul>
<?php
}
?>

<div id="user-locations"></div>
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
        $('#user-list li a').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#user-locations').load(url, function() {
                alert('Event fired with url: ' + url);
            });
        });
    });
</script>
@endsection