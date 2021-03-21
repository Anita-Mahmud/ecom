<style>
    h1{
        color:blue;
    }
</style>
<h1>Invoice ID {{ $data->id }}</h1>
<h1>Total {{ $data->total }}</h1>
<h1>Discount {{ $data->discount }}</h1>

<table>
    <tr>
        <th>Product Name</th>
         <th>Product Price</th>
         <th>Product Quantity</th>

    </tr>
    @foreach (App\Models\Order_detail::where('order_id',$data->id)->get() as $order_detail)
    <tr>
        <td>{{ $order_detail->product_name }}</td>
         <td>{{ $order_detail->product_price }}</td>
           <td>{{ $order_detail->product_quantity }}</td>

    </tr>
    @endforeach
</table>

