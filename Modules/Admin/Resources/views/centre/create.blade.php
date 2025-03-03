@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10">
          <div class="card" style="border-radius: 0">
            <div class="card-header card-header-icon card-header-rose">
              <h4 class="card-title">Add Centre
              </h4>
            </div>
            <div class="card-body">
              
                <form action="/admin/centres" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin::centre.partials.centre-form')

                <div class="row mt-3">
                    <div class="col-md-12">
                        <a class="btn btn-secondary text-white" onclick="history.back()">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Save</button>
                      <div class="clearfix"></div>
                    </div>
                </div>
               
              </form>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection