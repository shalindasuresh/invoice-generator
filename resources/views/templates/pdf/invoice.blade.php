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
        background-color: #e9ecef;
        color: #838080;
    }
</style>

<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
    <tr>
        <td>
            <img src="<?php echo $data['banner_url']?>" width="150" height="150"/>
        </td>
        <td>
            Invoice
        </td>
    </tr>

    <tr>
        <td>
            <span class="font-weight-bold">{{$data['receiver']}}</span>
        </td>
        <td>
            <span class="text-black-50">Bill To</span>
            <div>
                <span class="font-weight-bold">{{$data['receiver']}}</span>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <p>Date :{{$data['date']}}</p>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            <p>Due Date :{{$data['due_date']}}</span>
        </td>
        <td>
        </td>
    </tr>

    <tr>
        <td>
            <p>Balance Due :{{$data['balance']}}</span>
        </td>
        <td>
        </td>
    </tr>
</table>

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
<div >

    <div></div>
    <div></div>
    <div>
        <p>Sub Total :{{$data['total']}}</p>
        <p>Total :{{$data['total']}}</p>
        <p>Amount Paid :{{$data['amount_paid']}}</p>
    </div>

</div>

<div>

    <div>
        <p>Notes</p>
        <p>{{$data['notes']}}</p>
        <p>Terms</p>
        <p>{{$data['terms']}}</p>
    </div>
    <div></div>
    <div>

    </div>

</div>
</body>
</html>
