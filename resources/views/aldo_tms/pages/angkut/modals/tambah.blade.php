<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('angkut.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="tgl_masuk" class="col-form-label">Tanggal Masuk</label>
                        </div>
                        <div class="col-9">
                            <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control" value="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nama" class="col-form-label">Nama Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nama" name="sopir_nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nik" class="col-form-label">NIK Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nik" name="sopir_nik" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_tlp" class="col-form-label">Telepon Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_tlp" name="sopir_tlp" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="transporter" class="col-form-label">Transporter</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="transporter" name="transporter" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nopol_mobil" class="col-form-label">Nopol Mobil</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nopol_mobil" name="nopol_mobil" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="customer" class="col-form-label">Customer</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="customer" name="customer" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="tgl_sj" class="col-form-label">Tanggal SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="date" class="form-control" id="tgl_sj" name="tgl_sj" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="no_sj" class="col-form-label">No. SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="no_sj" name="no_sj" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nama_barang" class="col-form-label">Nama Barang</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                        </div>
                        <div class="col-9">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="safety_check" class="col-form-label">Safety Check</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="safety_check" id="safety_check">
                                <option value="1">Safety</option>
                                <option value="0">Not Safety</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="empty_in" class="col-form-label">Empty In</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="empty_in" id="empty_in">
                                <option value="1">Full</option>
                                <option value="0">Empty</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="photo_sim" class="col-form-label">Foto SIM</label>
                        </div>
                        <div class="col-9">
                            <img id="previewPhotoSim" src="" style="display:none; width: 100px; height: auto;" />
                            <input type="hidden" id="photo_sim" name="foto_sim"> <!-- Base64 Data --> <!-- Show Path -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#captureModal1">
                                Ambil Foto SIM
                            </button>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="photo_stnk" class="col-form-label">Foto STNK</label>
                        </div>
                        <div class="col-9">
                        <img id="previewPhotoStnk" src="" style="display:none; width: 100px; height: auto;" />
                            <input type="hidden" id="photo_stnk" name="foto_stnk"> <!-- Base64 Data --> <!-- Show Path -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#captureModal2">
                                Ambil Foto STNK
                            </button>
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
        </div>
    </div>
</div>

<!-- Include Capture Modals -->
@include('aldo_tms.pages.angkut.modals.capture1')
@include('aldo_tms.pages.angkut.modals.capture2')



