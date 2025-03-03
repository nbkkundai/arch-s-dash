    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-0" id="parameter-details">Logs</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    @if(empty($data['file']))
                        <h3>No log data.</h3>
                    @else
                        <div>
                            <h5>Updated on: <b>{{$data['lastModified']->format('Y-m-d H:i a')}}</b></h5>
                            <h5>File size: <b>{{round($data['size']/1024)}} KB</b></h5>
                            <pre>{{$data['file']}}</pre>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>