@foreach (['success', 'warning', 'danger', 'primary', 'light','info'] as $status)
    @if (session($status))
        <div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">
            <strong>{{ session($status) }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach

{{-- <script>
    setTimeout(() => {
        $('.alert').hide('slow')
    }, 3000);
</script> --}}
