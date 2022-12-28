@extends('layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y" id="app">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <device-lists></device-lists>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{ mix('/js/device.js') }}"></script>

@endsection