<div>
    <div class="row mt-4">
        <div class="col-md-4">
            <label class="form-label">Project name</label>
            <input name="name" type="text" class="form-control">
            @error('name')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Client</label>
            <select data-plugin="select2" name="client_id" class="form-control">
                @foreach($clients as $client)
                    <option @if($client->selected) selected @endif value="{{$client->id}}">{{$client->code}} - {{$client->first_name}} {{$client->last_name}}</option>
                @endforeach
            </select>
            @error('client_id')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Location</label>
            <input name="location" type="text" class="form-control">
            @error('location')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <label class="form-label">Bulding type</label>
            <select data-plugin="select2" name="building_type_id" class="form-control">
                @foreach($building_types as $building_type)
                    <option @if($building_type->selected) selected @endif value="{{$building_type->id}}">{{$building_type->name}}</option>
                @endforeach
            </select>
            @error('building_type_id')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Budget</label>
            <input name="budget" type="number" class="form-control">
            @error('budget')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <label class="form-label">Stages</label>
            <select data-plugin="select2" name="processes[]" required class="form-control js-example-basic-multiple" multiple="multiple">
                @foreach($processes as $process)
                    <option @if($process->selected) selected @endif value="{{$process->id}}">{{$process->name}}</option>
                @endforeach
            </select>
            @error('processes')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <a class="btn btn-secondary text-white" onclick="history.back()">Back</a>
        <button type="submit" class="btn btn-success pull-right">Save</button>
        <div class="clearfix"></div>
        </div>
    </div>
</div>