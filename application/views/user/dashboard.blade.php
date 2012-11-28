@layout('user.master')

@section('content')
<h1>Dashboard <small>Welcome, <?php echo Session::get('username') ?>!</small></h1>

@if(!empty($user))
<dl class="dl-horizontal">
    <dt>Username</dt>
    <dd>{{ $user->user_name }}</dd>
    <dt>PSRN</dt>
    <dd>{{ $user->details->psrn }}</dd>
</dl>
@endif

<div id="user-roles"></div>

<div id="next-form">
@section('next-form')
@endsection
</div>

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    var url = '<?php echo url('common/user_roles') ?>';
    var userId = '{{ $user->details->id }}';
    $('#user-roles').load(url, { id: userId }, function() {
        
    });
});
</script>
@endsection