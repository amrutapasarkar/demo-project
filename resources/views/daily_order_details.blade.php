<p>Dear Administrator,</p>
<p>Please check below details of the today's order.</p>
<table border="1" cellpadding="10px" width="100%">
    <thead>
        <tr>
            <th>Sr. NO</th><th>Order No</th><th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderdetails as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->grand_total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


