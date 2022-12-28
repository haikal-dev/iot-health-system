@extends('layouts.app')

@section('content')

            <div class="container-xxl flex-grow-1 container-p-y" id="app">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <main-patient></main-patient>
                </div>
              </div>
            </div>
            <!-- / Content -->

@endsection

@section('scripts')

<script src="{{ mix('/js/patients.js') }}"></script>

@endsection