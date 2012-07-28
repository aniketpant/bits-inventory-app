@layout('user.master')

@section('content')
<div class="hero-unit">
    <h1>Welcome!</h1>
    <p>Please proceed to the <a href="<?php echo url('user/login') ?>">login page</a>.</p>
</div>
@endsection