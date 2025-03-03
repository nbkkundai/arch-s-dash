@extends('layouts.app')

@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Process: </b> {{$process->name}}</h5>
                <p>Project: {{$project->name}}</p>
            </div>
            <div class="col-6">
                <a href="/projects/{{$project->id}}" class="btn float-right"> Back to project</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card p-3">
                <div class="card-title">
                    <h6>Project details</h6>
                    <hr>
                </div>
           
                <p><b>Name: </b>{{$project->name}}</p>
                <p><b>Client: </b> {{$project->client->first_name}}  {{$project->client->last_name}}</p>
                <p><b>Address: </b>{{$project->location}}</p>
                <p><b>Building type: </b></p>
            </div>
        </div>
        <div class="col-8">
            <div class="card p-3" style="min-height:200px; border-radius: 0">
                <div class="card-title">
                    <h6>Project Process requirements</h6>
                    {{-- @if(Auth::user()->hasAnyRole(['Client'])) --}}
                    <hr>
                        @foreach($process->questions as $question)
                            <form action="/projects/{{$project->id}}/processes/{{$process->id}}/questions/{{$question->id}}/response" method="POST" enctype="multipart/form-data">
                                @csrf

                                <h6>{{$question->name}}</h6>

                                @if($question->type == "text" || $question->type == "number")
                                    <div class="col-md-6">
                                        <input name="text_answer" type="text" class="form-control" >
                                        @error('text_answer')
                                            <span class="invalid-feedback" style="display:unset;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @elseif($question->type == "multi_select")
                                    <p>multi select input</p>
                                @elseif($question->type == "single_select")
                                    <p>single select input</p>
                                @else
                                    <div class="fileinput fileinput-new form-group col-md-6" data-provides="fileinput" >
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                        <div>
                                            <span class="btn btn-danger btn-file">
                                            <span class="fileinput-new">Upload Document</span>
                                            <span class="fileinput-exists">Change</span>
                                                <input type="file" name="document"/>
                                                @error('deposit_slip')
                                                    <span class="invalid-feedback" style="display:unset;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">Save</button>
                                    </div>
                                </div>
                            </form>
                            @if($question->response)
                                <div class="p-3" style="border-radius: 0"> @include('upload::show-uploads')</div>
                                @else
                                <div class="p-3" style="border-radius: 0">No uploads yet</div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
