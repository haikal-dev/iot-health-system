@extends('layouts.app')

@section('content')

            <div class="container-xxl flex-grow-1 container-p-y" id="app">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="nav-align-top mb-4">
                      <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                          <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-patient-list"
                            aria-controls="navs-patient-list"
                            aria-selected="true"
                          >
                            Informations
                            <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span> -->
                          </button>
                        </li>
                        <li class="nav-item">
                          <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-justified-profile"
                            aria-controls="navs-justified-profile"
                            aria-selected="false"
                          >
                            Requests
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-patient-list" role="tabpanel">
                          <patient-list></patient-list>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                          <patient-requests></patient-requests>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="card">
                      <div class="card-body">
                        <h3 class="mb-4" style="font-weight: bold;">Patient's Information</h3>
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Registered At</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div> -->
                  </div>
              </div>
            </div>
            <!-- / Content -->

@endsection

@section('scripts')

<script src="{{ mix('/js/patients.js') }}"></script>

@endsection