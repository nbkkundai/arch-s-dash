@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card p-3" style="min-height:200px; border-radius: 0">
                <div class="row">
                    <div class="col-md-6 pt-2">
                        <h3>Group: {{$group->name}}</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="/client/groups" class="btn btn-primary float-right">All Groups&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                        <button data-toggle="modal" data-target="#historyModal{{$group->id}}" type="button" class="btn pull-right">
                            <i class="fa fa-history mr-2"></i>History
                        </button>
                        <a href="/client/groups/{{$group->slug}}/edit" class="btn btn-secondary float-right"><i class="fa fa-pencil mr-2"></i> Edit</a>
                        <div class="modal fade" id="historyModal{{$group->id}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title text-left" id="exampleModalLongTitle">
                                    History of {{$group->name}}
                                  </h5>
                              </div>
                              <div class="modal-body">
                                <table class="table">
                                  <thead>
                                      <tr>
                                          <th>User Name</th>
                                          <th>Action</th>
                                          <th>Old value</th>
                                          <th>New value</th>
                                          <th>Date</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($group->audits as $audit)
                                      <tr>
                                          <td>{{$audit->user->full_name}}</td>
                                          <td>{{$audit->event}}</td>
                                          <td>
                                            @foreach($audit->old_values as $key => $value)
                                              Old {{$key}}: {{$value}} <br>
                                            @endforeach
                                          </td>
                                          <td>
                                            @foreach($audit->new_values as $key => $value)
                                              New {{$key}}: {{$value}} <br>
                                            @endforeach
                                          </td>
                                          <td>{{$audit->updated_at}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
                              </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <table class="table">
                                <tbody> 
                                    <tr>
                                        <td>Group Name</td>
                                        <td>{{$group->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Group number</td>
                                        <td>{{$group->group_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Serial number</td>
                                        <td>{{$group->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Centre</td>
                                        <td>{{$group->centre->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Zone</td>
                                        <td>{{$group->zone_name}} - {{$group->zone_code}}</td>
                                    </tr>
                                    <tr>
                                        <td>Area Code</td>
                                        <td>{{$group->area_code}}</td>
                                    </tr>

                                    <tr>
                                        <td>Area Officer</td>
                                        <td>{{$group->area_officer}}</td>
                                    </tr>

                                    <tr>
                                        <td>Bank</td>
                                        <td>{{$group->bank_account_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank account number</td>
                                        <td>{{$group->bank_account_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Post office</td>
                                        <td>{{$group->post_office}}</td>
                                    </tr>
                                    <tr>
                                        <td>Metting schedule</td>
                                        <td>{{$group->meeting_day}} - {{$group->meeting_time}}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 
    <div class="card p-3" style="border-radius: 0">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-6">
            </div>
        </div><hr>
        <div class="card-body p-0" style="border-radius: 0">
        </div>  
    </div> -->
    <div class="card p-3" style="border-radius: 0"> 
        @include('upload::show-uploads')
    </div>
    <div class="card p-3" style="border-radius: 0"> 
        <div class="row">
            <div class="col-6">
                <h3>Loans</h3>
            </div>
            <div class="col-6">
                <a href="/client/groups/{{$group->slug}}/loan/create" class="btn btn-secondary float-right">Add Loan</a>
            </div>
            @error('message')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="card-body p-0">
            @if($loans->isNotEmpty())
                @include('loan::loans.partials.loans-table')
            @else
                <p>No loans found.</p>
            @endif
        </div><!-- end content-->
    </div>
    <div class="card p-3" style="border-radius: 0">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-2">Members</h2>
            </div>
            <div class="col-md-6">
                <form action="{{$group->slug}}/download" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn pull-right">
                        <i class="fa fa-download mr-2"></i>Download
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body p-0" style="border-radius: 0">
            @include('client::client.partials.clients-table')
        </div>  
    </div>
</div>

@endsection

@push('scripts')
<script src="dataTables/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#datatable').DataTable();
} ); </script>
@endpush