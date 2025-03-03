<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>members</title>
</head>
<body>
    <div>
        <h4>Sunrise Women Development Application Form</h4>
        <h6>22 Kiaat Street Arbor Park Newcastle 2940</h6>
        <h6>tel 034 326 8005</h6>
        <br>
        <form>
            <div class="form-row">
              <div class="form-group col-md-4">
                <p>Zone name : {{$group->zone_name}} Zone code : {{$group->zone_name}}</p>
                <p>Centre : {{$group->center_id}}</p>
                <p>Group Name : {{$group->name}} Group number : {{$group->group_number}}</p>
                <p>Serial number : {{$group->id}}</p>
              </div>
            </div>
        </form>
        <br>
        <h4>Tax invoice No:</h>
        <br>
        <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ID Number</th>
                </tr>
            </thead>
           
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{$client->first_name}} {{$client->last_name}}</td>
                    <td>{{$client->id_number}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
    </div> 
</body>
</html>