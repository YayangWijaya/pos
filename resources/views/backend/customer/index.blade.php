@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Customer</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                              <a class="btn btn-solid" href="javascript:void(0)"
                              data-bs-toggle="modal" data-bs-target="#mediaModel">Export</a>
                            </li>
                            <li>
                                <form class="d-flex align-items-center" action="{{ route('transaction.index') }}" method="get">
                                    <input type="text" class="form-control" name="from" id="from" placeholder="Search customer"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th class="text-start">Name</th>
                                    <th class="text-start">Entity</th>
                                    <th class="text-start">Email</th>
                                    <th class="text-start">Phone</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="text-start">PT Lamjaya Global Solusi</td>
                                    <td class="text-start">Perseroan Terbatas</td>
                                    <td class="text-start">support@lamsolusi.com</td>
                                    <td class="text-start">0215135346</td>
                                    <td>Jakarta</td>
                                    <td>
                                      <ul class="nav-menus">
                                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                                          <div class="media profile-media">
                                            <i class="ri-more-fill"></i>
                                          </div>
                                          <ul class="profile-dropdown onhover-show-div">
                                            <li>
                                              <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                href="javascript:void(0)">
                                              <i data-feather="log-out"></i>
                                                <span>Log out</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">PT. Rhadana Hospitality Indonesia</td>
                                    <td class="text-start">Perseroan Terbatas</td>
                                    <td class="text-start">halo@rhi.com</td>
                                    <td class="text-start">0216374543</td>
                                    <td>Jakarta</td>
                                    <td>
                                      <ul class="nav-menus">
                                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                                          <div class="media profile-media">
                                            <i class="ri-more-fill"></i>
                                          </div>
                                          <ul class="profile-dropdown onhover-show-div">
                                            <li>
                                              <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                href="javascript:void(0)">
                                              <i data-feather="log-out"></i>
                                                <span>Log out</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Archipelago International</td>
                                    <td class="text-start">Perseroan Terbatas</td>
                                    <td class="text-start">hello@archipelago.com</td>
                                    <td class="text-start">02153645623</td>
                                    <td>Jakarta</td>
                                    <td>
                                      <ul class="nav-menus">
                                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                                          <div class="media profile-media">
                                            <i class="ri-more-fill"></i>
                                          </div>
                                          <ul class="profile-dropdown onhover-show-div">
                                            <li>
                                              <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                href="javascript:void(0)">
                                              <i data-feather="log-out"></i>
                                                <span>Log out</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Wan Kodir</td>
                                    <td class="text-start">Perorangan</td>
                                    <td class="text-start">wankodir@gmail.com</td>
                                    <td class="text-start">08521643745</td>
                                    <td>Bekasi</td>
                                    <td>
                                      <ul class="nav-menus">
                                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                                          <div class="media profile-media">
                                            <i class="ri-more-fill"></i>
                                          </div>
                                          <ul class="profile-dropdown onhover-show-div">
                                            <li>
                                              <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                href="javascript:void(0)">
                                              <i data-feather="log-out"></i>
                                                <span>Log out</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Media modal start -->
<div class="modal fade media-modal" id="mediaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Maintain Customer</h2>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal"><span
                    class="lnr lnr-cross"></span></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
              <table class="table all-package theme-table table-product" id="table_id">
                  <thead>
                      <tr>
                          <th>Product Image</th>
                          <th class="text-start">Product Name</th>
                          <th class="text-end">Base Price (Rp)</th>
                          <th class="text-center">USD Price</th>
                          <th class="text-center">CNY Price</th>
                          <th class="text-center">KRW Price</th>
                      </tr>
                  </thead>

                  <tbody>
                      @forelse ($products as $index => $product)
                      <tr>
                          <td>
                              <div class="table-image">
                                  <img src="{{ asset($product->image_link) }}" class="img-fluid" alt="{{ $product->name }}">
                              </div>
                          </td>

                          <td class="text-start">{{ $product->name }}</td>

                          <td class="td-price text-end">{{ $product->price_formatted }}</td>

                          <td class="text-center">
                            <input class="form-control" name="usd_price" id="usd_price"/>
                          </td>
                          <td class="text-center">
                            <input class="form-control" name="cny_price" id="cny_price"/>
                          </td>
                          <td class="text-center">
                            <input class="form-control" name="krw_price" id="krw_price"/>
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5">No Data</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
        </div>
        <div class="modal-footer">
            <div class="right-part">
                <a href="#" class="btn btn-solid">Save</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Insert Media modal end -->
@endsection
