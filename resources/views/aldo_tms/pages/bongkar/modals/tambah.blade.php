<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('bongkar.store') }}">
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
                            <input type="text" id="kode_trans" name="kode_trans" class="form-control"
                                value="{{ $kodeTrans }}" readonly>
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
                            <input type="text" id="sopir_nama" name="sopir_nama" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nik" class="col-form-label">NIK Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nik" name="sopir_nik" class="form-control"
                                placeholder="Masukkan NIK" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_tlp" class="col-form-label">Tlp Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_tlp" name="sopir_tlp" class="form-control"
                                placeholder="Masukkan No Tlp" required>
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
                            <label for="supplier" class="col-form-label">Supplier</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="supplier" name="supplier" class="form-control"
                                placeholder="Masukkan Supplier" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="no_sj" class="col-form-label">No. SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="no_sj" name="no_sj" class="form-control"
                                placeholder="Masukkan No. Surat Jalan" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="no_sj" class="col-form-label">Tgl SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="date" id="tgl_sj" name="tgl_sj" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nama_barang" class="col-form-label">Nama Barang</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control"
                                placeholder="Masukkan Nama Barang" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="ket_in" class="col-form-label">Ket. Masuk</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" id="ket_in" name="ket_in" class="form-control"
                                placeholder="Masukkan Keterangan" required>
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
                            <label for="waktu_in" class="col-form-label">Waktu Masuk</label>
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