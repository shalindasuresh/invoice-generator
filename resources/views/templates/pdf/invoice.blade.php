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
{{--                <div>--}}
{{--                    <span class="text-black-50">Ship To</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <span class="font-weight-bold">{{$data['receiver']}}</span>--}}
{{--                </div>--}}

            </div>
        </div>

    </div>

    <div class="col-md-6">
        <h2>INVOICE</h2>

    </div>

</div>
<style>
    #items {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #items td, #items th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #items tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #items tr:hover {
        background-color: #ddd;
    }

    #items th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #999d99;
        color: white;
    }
</style>


<table id="items">
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th>Amount</th>
    </tr>

    @foreach (json_decode($data['items']) as $item)
        <tr>
            <td data-column="Item">{{ $item->name }}</td>
            <td data-column="Quantity">{{ $item->qty }}</td>
            <td data-column="Rate">{{ $item->rate }}</td>
            <td data-column="Amount">{{ $item->qty* $item->rate }}</td>
        </tr>
    @endforeach
</table>

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
