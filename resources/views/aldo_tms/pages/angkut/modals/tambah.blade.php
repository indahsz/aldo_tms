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
                            <label for="kode_trans" class="col-form-label">No. Transaksi</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="kode_trans" name="kode_trans" class="form-control" value="{{ $kodeTrans }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="departement" class="col-form-label">Departement</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="departement" name="departement" class="form-control" 
                                value="{{ auth()->user()->departement }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nama" class="col-form-label">Nama Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nama" name="sopir_nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nik" class="col-form-label">NIK Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nik" name="sopir_nik" class="form-control" placeholder="Masukkan NIK" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_tlp" class="col-form-label">Tlp Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_tlp" name="sopir_tlp" class="form-control" placeholder="Masukkan No Tlp" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="transporter" class="col-form-label">Transporter</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="transporter" id="transporter">
                                <option value="-">--Pilih--</option>
                                <option value="Internal">Kendaraan Internal</option>
                                <option value="Eksternal">Kendaraan Eksternal</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="armada" class="col-form-label">Armada</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="armada" name="armada" class="form-control" placeholder="Masukkan Armada" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nopol_mobil" class="col-form-label">Nopol Mobil</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nopol_mobil" name="nopol_mobil" class="form-control"
                                placeholder="Masukkan Plat Mobil" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="ket_in" class="col-form-label">Ket. Masuk</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" id="ket_in" name="ket_in" class="form-control"
                                placeholder="Masukkan Keterangan"
                                required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="safety_check" class="col-form-label">Kelengkapan</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="safety_check" id="safety_check">
                                <option value="-">--Pilih--</option>
                                <option value="Lengkap">Lengkap</option>
                                <option value="Tidak Lengkap">Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="empty_in" class="col-form-label">Mobil Kosong?</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="empty_in" id="empty_in">
                                <option value="-">--Pilih--</option>
                                <option value="Ya">Ya (Kosong)</option>
                                <option value="Tidak">Tidak (Terisi)</option>
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