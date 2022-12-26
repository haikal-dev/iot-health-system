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
                            data-bs-target="#navs-justified-home"
                            aria-controls="navs-justified-home"
                            aria-selected="true"
                          >
                            Informations
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span>
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
                        <li class="nav-item">
                          <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-justified-messages"
                            aria-controls="navs-justified-messages"
                            aria-selected="false"
                          >
                            Etc.
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                          <p>
                            Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps
                            powder. Bear claw candy topping.
                          </p>
                          <p class="mb-0">
                            Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon
                            jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow
                            jujubes sweet.
                          </p>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                          <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                            cheesecake fruitcake.
                          </p>
                          <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                            cotton candy liquorice caramels.
                          </p>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                          <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                          </p>
                          <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                            jelly-o tart brownie jelly.
                          </p>
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