<?php
if ($users):
?>
<h3>List of users</h3>
<ul>
<?php
foreach($users as $user):
?>
    <li><a href="<?php echo url('admin/dashboard/controls/alloted_locations/' . $user->details->id); ?>"><?php echo $user->user_name; ?></a></li>
<?php
endforeach;
?>
</ul>
<?php
endif;
?>