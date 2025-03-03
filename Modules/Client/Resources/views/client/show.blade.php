@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card p-3" style="min-height:200px; border-radius: 0">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Client: {{$client->initials}} {{$client->last_name}} </h3>
                    </div>
                    <div class="col-md-8">
                        <a href="/client/clients" class="btn btn-primary float-right">All clients&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                        <button data-toggle="modal" data-target="#historyModal{{$client->id}}" type="button" class="btn pull-right"><i class="fa fa-history mr-2"></i> History</button>
                        <a href="/client/clients/{{$client->slug}}/edit" class="btn btn-secondary float-right"><i class="fa fa-pencil mr-2"></i> Edit</a>
                        <div class="modal fade" id="historyModal{{$client->id}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title text-left" id="exampleModalLongTitle">History of {{$client->full_name}}</h5>
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
                                    @foreach ($audits as $audit)
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
                                    <td>Group</td>
                                    <td>
                                        <a href="/client/groups/{{$client->groups->last()->slug}}">{{$client->groups->last()->slug}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Client number</td>
                                    <td>{{$client->client_number}}</td>
                                </tr>
                                <tr>
                                    <td>ID number</td>
                                    <td>{{$client->id_number}}</td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td>{{$client->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$client->address_line_1}}, {{$client->address_line_2}}, {{$client->city}}, {{$client->code}}, {{$client->province}}</td>
                                </tr>
                                <tr>
                                    <td>Business</td>
                                    <td> Years - {{$client->years_in_business}} <br> Type - {{$client->business_type}} <br> Employment type - {{$client->employment_type}}</td>
                                </tr>
                                {{-- 
                                    <tr>
                                        <td>Id type</td>
                                        <td>{{$client->id_type}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of birth</td>
                                        <td>{{$client->date_of_birth}}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{$client->sex}}</td>
                                    </tr>
                                    <tr>
                                        <td>Citizenship</td>
                                        <td>{{$client->citizenship}}</td>
                                    </tr>
                                    <tr>
                                        <td>Marital status</td>
                                        <td>{{$client->marital_status}}</td>
                                    </tr>
                                    <tr>
                                        <td>Postal address</td>
                                        <td>{{$client->postal_line_1}}, {{$client->postal_line_2}}, {{$client->city}}</td>
                                    </tr>
                                    <tr>
                                        <td>Postal Region</td>
                                        <td>{{$client->postal_region}}</td>
                                    </tr>
                                    <tr>
                                        <td>Postal code</td>
                                        <td>{{$client->postal_code}}</td>
                                    </tr> 
                                    <tr>
                                        <td>Country</td>
                                        <td>{{$client->country_id}}</td>
                                    </tr> 
                                --}}
                                <tr>
                                    <td>
                                        Created at:
                                    </td>
                                    <td>
                                        {{$client->created_at}} ({{Carbon\Carbon::parse($client->created_at)->diffForHumans()}})
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Updated at:
                                    </td>
                                    <td>
                                        {{$client->created_at}} ({{Carbon\Carbon::parse($client->updated_at)->diffForHumans()}})
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Notes:
                                    </td>
                                    <td class="pt-4">
                                        <x-notes :client="$client" :process="$client->client_notes->where('type','process')" :redflags="$client->client_notes->where('type','red flag')" :personal="$client->client_notes->where('type','personal')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3" style="border-radius: 0"> 
        @include('upload::show-uploads')
    </div>
</div>

@endsection
