@isset($item)
<div class="modal fade" id="muat-start{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Muat Dimulai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('angkut.muatStart', $item->id) }}">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="kode_trans" class="col-form-label">Kode Transaksi</label>
                        </div>
                        <div class="col-3">
                            <label for="kode_trans" class="col-form-label"><h1>{{ $item->kode_trans }}</h1></label>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="muat_start" class="col-form-label">Mulai Muat</label>
                        </div>
                        <div class="col-9">
                            <input type="datetime-local" class="form-control" id="muat_start" name="muat_start"
                                value="{{ $item->muat_start }}" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="submit" class="btn btn-primary">Muat Start</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endisset