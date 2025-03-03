@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-2">{{$centre->name}}</h2>
            </div>
            <div class="col-md-6">
                <a href="/admin/centres" class="btn btn-primary float-right">All Centres<i class="fa fa-arrow-right ml-2"></i></a>

                <button data-toggle="modal" data-target="#historyModal{{$centre->id}}" type="button" class="btn pull-right">
                    <i class="fa fa-history mr-2"></i>History
                </button>
                <div class="modal fade" id="historyModal{{$centre->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-left" id="exampleModalLongTitle">History of {{$centre->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>User Name</th>
                                    <th>Action</th>
                                    <th>Old value</th>
                                    <th>New value</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($centre->audits as $audit)
                                <tr>
                                    <td class="text-center"></td>
                                    <td>{{$audit->user?->full_name}}</td>
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
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th><b>Description</b></th>
                        <th><b>Details</b></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Centre Code</td>
                            <td>{{$centre->code}}</td>
                        </tr>
                        <tr>
                            <td>Centre Name</td>
                            <td>{{$centre->name}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$centre->address_line_1}}, {{$centre->address_line_2}}, {{$centre->city}}</td>
                        </tr>
                        <tr>
                            <td>Province</td>
                            <td>{{$centre->province}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

    <div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-2">Groups</h2>
            </div>
            <div class="col-md-6">
                <!--  -->
            </div>
        </div>
        <div class="card-body p-0">
            @include('client::group.partials.groups-table')
        </div>  
    </div>
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-2">Clients</h2>
            </div>
            <div class="col-md-6">
                <!--  -->
            </div>
        </div>
        <div class="card-body p-0">
            @include('client::client.partials.clients-table')
        </div>  
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="/assets/vendor/select2/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({});
    });
</script>

@endsection