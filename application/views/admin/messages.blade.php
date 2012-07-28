@if($message)
<div class="alert alert-block">{{ $message }}</div>
@endif

@if($deleted)
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var value = '{{ $deleted }}';
        var id = '{{ $id }}';
        
        $('select[name*="' + id + '"]').val(value).trigger('change');
        
    });
</script>
@yield_section
@endif