    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-0" id="parameter-details">All dev tool links</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($links as $title => $link)
                        <a href="{{$link}}">{{$title}}</a> <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>