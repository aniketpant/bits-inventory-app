<?php
    if ($locations):
?>
<h3>Locations the user has been alloted</h3>
<ul>
<?php
    foreach ($locations as $location):
?>
    <li><?php echo $location->location_name; ?></li>
<?php
    endforeach;
?>
</ul>
<?php
    endif;

?>
<?php
    if ($roles):
?>
<h3>Roles the user has been authorized</h3>
<ul>
<?php
    foreach ($roles as $role):
?>
    <li><?php echo $role->role_name; ?></li>
<?php
    endforeach;
?>
</ul>
<?php
    endif;

?>