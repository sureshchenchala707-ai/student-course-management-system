
<!DOCTYPE html>
<html>
<head>

<title>Invoice</title>

<style>

body{
    font-family:Arial;
    padding:30px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,th,td{
    border:1px solid #ddd;
}

th,td{
    padding:10px;
}

h2{
    margin-bottom:20px;
}

</style>

</head>
<body>

<h2>Course Payment Invoice</h2>

<hr>

<p>
<strong>Invoice No:</strong>
#{{ $payment->id }}
</p>

<p>
<strong>Student:</strong>
{{ $payment->user->name }}
</p>

<p>
<strong>Email:</strong>
{{ $payment->user->email }}
</p>

<table>

<tr>
<th>Course</th>
<th>Amount</th>
<th>Status</th>
</tr>

<tr>

<td>
{{ $payment->course->title }}
</td>

<td>
₹{{ $payment->amount }}
</td>

<td>
{{ ucfirst($payment->status) }}
</td>

</tr>

</table>

<br>

<p>
<strong>Payment ID:</strong>
{{ $payment->payment_id }}
</p>

<p>
<strong>Date:</strong>
{{ $payment->created_at }}
</p>

<br>

<p>
Thank you for your purchase.
</p>

</body>
</html>

