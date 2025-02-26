@extends('aldo_tms.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ Auth::user()->name }} 🎉</h5>
                            <p class="mb-4">
                                Selamat datang di <span class="fw-bold">ALGATE</span>.
                                Aplikasi berbasis web untuk pendataan masuk-keluar kendaraan (angkutan) yang melewati gerbang PT Alkindo Naratama Tbk.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="../assets/img/illustrations/img_fleet.png"
                                height="140"
                                alt="View Badge User"
                                data-app-dark-img="illustrations/img_fleet.png"
                                data-app-light-img="illustrations/img_fleet.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <!-- </div>
    <div class="row"> -->
            </div>
        </div>
    </div>
</div>

@endsection