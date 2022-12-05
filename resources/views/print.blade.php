<!DOCTYPE html>
<html>
<head>
	<title>Report Transaction</title>
    
    <style type="text/css">
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    table td,
    table th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    table tr:nth-child(even){background-color: #f2f2f2;}
    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: red;
        color: white;
    }
    </style>
</head>
<body>
    <center>
        <h2>Report Transaction</h2>
    </center>
 
	<br/>
 
	<table>
        <thead>
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
            <tr>
                <td>{{ $transaction['doc_code'].'-'.$transaction['doc_number'] }}</td>
                <td>{{ $transaction['author']['name'] }}</td>
                <td>{{ $transaction['total'] }}</td>
                <td>{{ $transaction['date'] }}</td>
                <td>
                    @foreach ($transaction['detail'] as $detail)
                    <p style="margin-bottom: 0;">{{ $detail['product']['name'].' x '.$detail['quantity'] }}</p>
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Data not available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
 
	<script>
		window.print();
	</script>
	
</body>
</html>