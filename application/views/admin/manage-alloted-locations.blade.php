@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Alloted Locations</h1>
@include('admin.search-form')
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