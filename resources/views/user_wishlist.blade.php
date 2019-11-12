
    <p>Dear Administrator,</p>
	<p>Please check below details of the user wishlist.</p>
    <table border="1" cellpadding="10px" width="100%">
        <thead>
            <tr>
                <th>Sr. NO</th><th>Order No</th><th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userswishlist as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
               	<td>{{ $item->id}}</td>  	
            </tr>
        @endforeach
        
        </tbody>
    </table>


