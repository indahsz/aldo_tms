<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('angkut.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="name" class="col-form-label">Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="name" class="col-form-label">Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>





                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="type_pet" class="col-form-label">Jenis Hewan</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="type_pet" name="type_pet" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="gender" class="col-form-label">Gender</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="gender" name="gender" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="age" class="col-form-label">Umur</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="age" name="age" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="favorite" class="col-form-label">Kesukaan</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="favorite" name="favorite" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="birth_date" class="col-form-label">Ulang Tahun</label>
                        </div>
                        <div class="col-9">
                            <input type="date" class="form-control" id="birth_date" name="birth_date"
                                value="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="special_notes" class="col-form-label">Notes</label>
                        </div>
                        <div class="col-9">
                            <textarea class="form-control" id="special_notes" name="special_notes" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="special_notes" class="col-form-label">Foto SIM</label>
                        </div>
                        <div class="col-9">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#captureModal1" data-modal-id="1">Capture Photo 1</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="special_notes" class="col-form-label">Foto STNK</label>
                        </div>
                        <div class="col-9">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#captureModal2" data-modal-id="2">Capture Photo 2</button>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
            </form>
            <!-- Include Capture Modals -->
            @include('aldo_tms.pages.angkut.modals.capture1')
            @include('aldo_tms.pages.angkut.modals.capture2')
        </div>
    </div>
</div>