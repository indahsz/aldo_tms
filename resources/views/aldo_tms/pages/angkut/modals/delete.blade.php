@isset($item)
    <div class="modal fade" id="delete-data{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('angkut.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <div >
                            <H6>Apakah Anda Yakin akan menghapus data ?</H6>
                        </div>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Hapus data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endisset
