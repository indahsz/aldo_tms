@extends('aldo_tms.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Bongkar Barang</h4>
    <button
        type="button"
        class="mb-4 btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#basicModal">
        + Tambah
    </button>
    <!-- Tabel Angkut -->
    <div class="card">
        <!-- <h5 class="card-header">Hoverable rows</h5> -->

        <div class="table-responsive text-nowrap">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tgl Masuk</th>
                        <th>Sopir</th>
                        <th>NIK</th>
                        <th>Tlp</th>
                        <th>Plat Mobil</th>
                        <th>Supplier</th>
                        <th>Tanggal SJ</th>
                        <th>No. SJ</th>
                        <th>Barang</th>
                        <th>Keterangan</th>
                        <th>SIM</th>
                        <th>STNK</th>
                        <th>Dokumen</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key +1 }} </td>
                        <td>{{ $item->tgl_masuk}} </td>
                        <td>{{ $item->sopir_nama}} </td>
                        <td>{{ $item->sopir_nik}} </td>
                        <td>{{ $item->sopir_tlp}} </td>
                        <td>{{ $item->nopol_mobil}} </td>
                        <td>{{ $item->supplier}} </td>
                        <td>{{ $item->tgl_sj}} </td>
                        <td>{{ $item->no_sj}} </td>
                        <td>{{ $item->nama_barang}} </td>
                        <td>{{ $item->keterangan}} </td>
                        <td>{{ $item->foto_sim}} </td>
                        <td>{{ $item->foto_stnk}} </td>
                        <td>{{ $item->foto_dokumen}} </td>
                        <td>{{ $item->waktu_in}} </td>
                        <td>{{ $item->waktu_out}} </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
</div>

@include('aldo_tms.pages.bongkar.modals.tambah')

@endsection