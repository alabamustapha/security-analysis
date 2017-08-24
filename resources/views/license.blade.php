@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">License</h3>
                    </div>
                    <div class="card-body">
                      <p>License</p>
                      <form>
                        <div class="form-group">
                          <input value="12seg-axfg-skjH-GG122-GH12" class="form-control" type="email" disabled>
                        </div>
                        
                        <div class="form-group">       
                          <input value="Refresh" class="btn btn-primary" type="submit">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Modal Form-->
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">License renewal</h3>
                    </div>
                    <div class="card-body text-center">
                      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Renew Licence</button>
                      <!-- Modal-->
                      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Signin Modal</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                              <form action="{{ url('/renew_license') }}" method="post" name="payuform">
                                {{ csrf_field() }}
                                <!-- <input type="hidden" name="key" value="i4YbRJcH" /> -->
                                <!-- <input type="hidden" name="hash_string" value="{{ $hash_string }}" /> -->
                                <!-- <input type="hidden" name="hash" value="{{ $hash }}" /> -->
                                <input type="hidden" name="txnid" value="{{ $txnid }}" />
                                <input type="hidden" name="amount"  value="1000" />
                                
                                <input name="productinfo" type="hidden" value="license renewal">

                                <input type="hidden" name="surl"  size="64" value="{{ url('/license') }}" />
                                <input type="hidden" name="furl"  size="64" value="{{ url('/license') }}" />
                                <input type="hidden" name="service_provider" value="payu_paisa" />
                                
                                
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input class="form-control" placeholder="Email Address" name="email" id="email" value="{{ Auth::user()->email }}">
                                </div>

                                <div class="form-group">       
                                  <label>Password</label>
                                  <input class="form-control" name="firstname" id="firstname"  value="{{ Auth::user()->name }}" />
                                </div>
                                <div class="form-group">
                                  <label>Phone Number</label>
                                  <input class="form-control" type="tel" name="phone"  placeholder=""  value="08095034525" />
                                </div>
                                <div class="form-group">       
                                  <input type="submit" value="Renew License" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
  </div>
  </section>

@endsection