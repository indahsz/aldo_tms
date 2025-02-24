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
                            <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control"
                                value="{{ \Carbon\Carbon::today()->toDateString() }}" required>
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
                            <label for="tgl_sj" class="col-form-label">Tgl SJ</label>
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
                            <input class="form-control" id="keterangan" name="keterangan" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="safety_check" class="col-form-label">Kelengkapan</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="safety_check" id="safety_check">
                                <option value="1">Lengkap</option>
                                <option value="0">Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="empty_in" class="col-form-label">Mobil Terisi?</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="empty_in" id="empty_in">
                                <option value="0">Kosong</option>
                                <option value="1">Terisi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="waktu_in" class="col-form-label">Waktu IN</label>
                        </div>
                        <div class="col-9">
                            <input type="datetime-local" class="form-control" id="waktu_in" name="waktu_in"
                                required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="submit" class="btn btn-primary">Simpan data</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>