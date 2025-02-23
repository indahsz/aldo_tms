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
                                <label for="sopir_nama" class="col-form-label">Nama Sopir</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="sopir_nama" name="sopir_nama" class="form-control"
                                    value="{{ $item->sopir_nama }}" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="sopir_nik" class="col-form-label">NIK Sopir</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="sopir_nik" name="sopir_nik" class="form-control"
                                    value="{{ $item->sopir_nik }}" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="sopir_tlp" class="col-form-label">Telepon Sopir</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="sopir_tlp" name="sopir_tlp" class="form-control"
                                    value="{{ $item->sopir_tlp }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="transporter" class="col-form-label">Transporter</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="transporter" name="transporter" class="form-control"
                                    value="{{ $item->transporter }}" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="nopol_mobil" class="col-form-label">Nopol Mobil</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="nopol_mobil" name="nopol_mobil" class="form-control"
                                    value="{{ $item->nopol_mobil }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="customer" class="col-form-label">Customer</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="customer" name="customer" class="form-control"
                                    value="{{ $item->customer }}" required>
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
                                    value="{{ $item->no_sj }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="nama_barang" class="col-form-label">Nama Barang</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="nama_barang" name="nama_barang" class="form-control"
                                    value="{{ $item->nama_barang }}" required>
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
                                <label for="empty_out" class="col-form-label">Mobil Terisi?</label>
                            </div>
                            <div class="col-9">
                                <select class="form-select" name="empty_out" id="empty_out">
                                    <option value="0">Kosong</option>
                                    <option value="1">Terisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="waktu_out" class="col-form-label">Keluar</label>
                            </div>
                            <div class="col-9">
                                <input type="datetime-local" class="form-control" id="waktu_out" name="waktu_out"
                                    required>
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
