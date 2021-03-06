<?php
    echo Form::open('common/search', 'POST', array('class' => 'well form-search', 'id' => 'search-form'));
    echo Form::input('text', 'username', Input::old('username'), array('class' => 'input-medium search-query', 'placeholder' => 'Enter username here'));
    echo Form::button('Search', array('class' => 'btn btn-info', 'id' => 'search-user'));
    echo Form::close();
?>

<div id="search-result">
@section('search-results')
@endsection
</div>

<div id="next-form">
@section('next-form')
@endsection
</div>
    
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#search-user').click(function(e) {
            e.preventDefault();
            var url = $('#search-form').attr('action');
            var inputUserName = $('input[name="username"]').val();
            $('#search-result').load(url, { username: inputUserName }, function() {
                $('#next-form').html('');
            });
        });
    });
</script>
@endsection