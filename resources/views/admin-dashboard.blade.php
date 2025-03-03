@extends('layouts.app')

@section('content')
<div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/admin/centres">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-bank text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8 pr-4">
                    <div class="numbers">
                      <p class="card-category">Projects</p>
                      <p class="card-title">{{$centre_count}}<p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/client/groups">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-layout-11 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8 pr-4">
                    <div class="numbers">
                      <p class="card-category">Groups</p>
                      <p class="card-title">{{$group_count}}<p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Last day
                </div>
              </div> -->
            </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/client/clients">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8 pr-4">
                    <div class="numbers">
                      <p class="card-category">Total Clients</p>
                      <p class="card-title">{{$clients_count}}<p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-refresh"></i>
                    At all centres
                </div>
              </div> -->
            </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 col-sm-12">
      </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Chart JS -->
<script src="/js/plugins/chartjs.min.js"></script>
@endsection