@extends('layouts.app')

@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Process: </b> {{$process->name}}</h5>
            </div>
            <div class="col-6">
                <a href="/projects/processes" class="btn float-right"> Back to processes</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card p-3">
                <div class="card-title">
                    <h6>Process details</h6>
                    <hr>
                </div>
           
                <p><b>Name: </b>{{$process->name}}</p>
                <p><b>Description: </b>{{$process->description}}</p>
            </div>
        </div>
        <div class="col-8">
            <div class="card p-3" style="min-height:200px; border-radius: 0">
                <div class="card-title">
                    <h6>Process questions</h6>
                    {{-- @if(Auth::user()->hasAnyRole(['Client'])) --}}
                    <hr>
                    @foreach($process->questions as $question)
                        <h6>{{$question->name}}</h6>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
