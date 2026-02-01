@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row g-3">

            <!-- STOKU -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-success h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-box text-success fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Stoku total</div>
                            <div class="fs-4 fw-bold">{{ $stok }} kg</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BORXH FURNITORË -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-danger h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-truck text-danger fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Borxh furnitorë</div>
                            <div class="fs-4 fw-bold text-danger">
                                {{ $borxhFurnitore }} €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BORXH KLIENTË -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-warning h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people text-warning fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Borxh klientë</div>
                            <div class="fs-4 fw-bold text-warning">
                                {{ $borxhKliente }} €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SHITJE SOT -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-primary h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-cash-stack text-primary fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Shitje sot</div>
                            <div class="fs-4 fw-bold text-primary">
                                {{ $shitjeSot }} €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
