@isset($item)
<div class="modal fade" id="update-data{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('angkut.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="kode_trans" class="col-form-label">Kode Transaksi</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="kode_trans" name="kode_trans" class="form-control"
                                value="{{ $item->kode_trans }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="tgl_masuk" class="col-form-label">Tgl Masuk</label>
                        </div>
                        <div class="col-9">
                            <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control"
                                value="{{ $item->tgl_masuk }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nama" class="col-form-label">Nama Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nama" name="sopir_nama" class="form-control"
                                value="{{ $item->sopir_nama }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_nik" class="col-form-label">NIK Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_nik" name="sopir_nik" class="form-control"
                                value="{{ $item->sopir_nik }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="sopir_tlp" class="col-form-label">Telepon Sopir</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="sopir_tlp" name="sopir_tlp" class="form-control"
                                value="{{ $item->sopir_tlp }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="armada" class="col-form-label">Armada</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="armada" name="armada" class="form-control"
                                value="{{ $item->armada }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="transporter" class="col-form-label">Transporter</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="transporter" name="transporter" class="form-control"
                                value="{{ $item->transporter }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nopol_mobil" class="col-form-label">Nopol Mobil</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nopol_mobil" name="nopol_mobil" class="form-control"
                                value="{{ $item->nopol_mobil }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="customer" class="col-form-label">Customer</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="customer" name="customer" class="form-control"
                                value="{{ $item->customer }}" placeholder="Masukkan Customer" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="tgl_sj" class="col-form-label">Tgl SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="date" class="form-control" id="tgl_sj" name="tgl_sj"
                                value="{{ $item->tgl_sj }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="no_sj" class="col-form-label">No. SJ</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="no_sj" name="no_sj" class="form-control"
                                value="{{ $item->no_sj }}" placeholder="Masukkan No. SJ" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="nama_barang" class="col-form-label">Nama Barang</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control"
                                value="{{ $item->nama_barang }}" placeholder="Masukkan Nama Barang" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="ket_out" class="col-form-label">Ket. Keluar</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" id="ket_out" name="ket_out" class="form-control"
                                value="{{ $item->ket_out }}" placeholder="Masukkan Keterangan" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="empty_out" class="col-form-label">Kondisi Mobil</label>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="empty_out" id="empty_out">
                                <option value="-">--Pilih--</option>
                                <option value="Ya">Ya (Kosong)</option>
                                <option value="Tidak">Tidak (Terisi)</option>
                            </select>
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
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="muat_stop" class="col-form-label">Selesai Muat</label>
                        </div>
                        <div class="col-9">
                            <input type="datetime-local" class="form-control" id="muat_stop" name="muat_stop"
                                value="{{ $item->muat_stop }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="waktu_out" class="col-form-label">Keluar</label>
                        </div>
                        <div class="col-9">
                            <input type="datetime-local" class="form-control" id="waktu_out" name="waktu_out"
                                value="{{ $item->waktu_out }}" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="submit" class="btn btn-primary">Update data</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endisset