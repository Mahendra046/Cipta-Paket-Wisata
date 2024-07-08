<a class="btn btn-sm bg-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" type="button" onclick="deleteData('{{ $id }}','{{ $path }}')">
    <i class="fa fa-trash"></i>
</a>

@push('script')
    @once
        <script>
            const deleteData = (id, path) => {
                const base_url = '{{ url('/') }}'
                const current_url = '{{ url()->current() }}'
                const url = path ? `${base_url}/${path}${id}` : `${current_url}/${id}`

                Swal.fire({
                    title: 'Apakah Anda Yakin Ingin Menghapus Data ini ?',
                    text: "Data dihapus Tidak Dapat di Kembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const csrf_token = `{{csrf_token()}}`
                        const template = `
                        <form method="post" action="${url}">
                            <input type="hidden" name="_token" value="${csrf_token}"/>
                            <input type="hidden" name="_method" value="delete"/>
                        </form>
                        `

                        $(template).appendTo('body').submit();
                    }
                })
            }
        </script>
    @endonce
@endpush
