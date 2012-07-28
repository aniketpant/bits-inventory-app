@layout('admin.master')

@section('content')
<h1 class="page-header">Manage Alloted Locations</h1>

<?php Session::put('primary_uri', URI::current()); ?>

@include('common.search-form')
@endsection

@section('errors')
@if($errors)
@foreach ($errors->all() as $error)
    <p class="alert alert-error"><?php echo $error; ?></p>
@endforeach
@endif
@endsection