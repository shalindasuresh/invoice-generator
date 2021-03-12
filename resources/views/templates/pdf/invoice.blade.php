<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
//echo json_encode($data['items']);die;
?>

{{--<body>--}}
{{--<h1>{{$data['receiver']}}</h1>--}}
{{--<h1>{{$data['sender']}}</h1>--}}
{{--<img src="{{ $data['banner_url']}}"/>--}}
{{--<img src="@php echo  $data['banner_url'] @endphp"/>--}}
{{--<img src="<?php echo $data['banner_url']?>" width="150" height="150"/>--}}
{{--</body>--}}
<body>
<div class="row">
    <div class="col-md-6">
        <div id="preview">
            <img src="<?php echo $data['banner_url']?>" width="150" height="150"/>
        </div>
        <div>
            <span class="font-weight-bold">{{$data['receiver']}}</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div>
                    <span class="text-black-50">Bill To</span>
                </div>
                <div>
                    <span class="font-weight-bold">{{$data['receiver']}}</span>
                </div>

            </div>
            <div class="col-md-6">
                <div>
                    <span class="text-black-50">Ship To</span>
                </div>
                <div>
                    <span class="font-weight-bold">{{$data['receiver']}}</span>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-6">
        <h2>INVOICE</h2>

    </div>

</div>

<div class="row">
    <div class="col-md-12">

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col text-center">Item</th>
                <th scope="col text-center">Quantity</th>
                <th scope="col text-center">Rate</th>
                <th scope="col text-center">Amount</th>
            </tr>
            </thead>
            <tbody>


            @foreach (json_decode($data['items']) as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->rate }}</td>
                    <td class="row">{{ $item->qty* $item->rate }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">

    </div>

    <div class="col-md-6">
        <p>
            <span>Total Amount :{{$data['total']}}</span>
        </p>
        <p>
            <span>Amount Paid :{{$data['amount_paid']}}</span>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label>Notes</label>
        <p>{{$data['notes']}}</p>
    </div>
    <div class="col-md-12">
        <label>Terms</label>
        <p>{{$data['terms']}}</p>
    </div>
</div>


</body>

</html>
