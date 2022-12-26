@extends('layouts.app')

@section('content')

            <div class="container-xxl flex-grow-1 container-p-y" id="app">
              <div class="row">
                <div class="col-lg-6 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <main-dashboard></main-dashboard>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <heartbeat-monitor></heartbeat-monitor>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <wifi-monitor></wifi-monitor>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <heartbeat-performance />
              </div>
            </div>
            <!-- / Content -->

@endsection

@section('scripts')

<!-- /js/dashboard.js -->
<script src="{{ mix('/js/dashboard.js') }}"></script>

@endsection