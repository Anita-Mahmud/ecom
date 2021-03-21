<h1 class="text-center">Your Orders</h1>
<table class="table table-bordered">
  <tr>
    <th>Order ID</th>
    <th>Total</th>
    <th>Discount</th>
     <th>SubTotal</th>
      <th>Action</th>
  </tr>
  @foreach ($orders_by_user as $order_by_user)
    <tr>
    <td>{{ $order_by_user->id }}</td>

    <td>{{ $order_by_user->total }}</td>
    <td>{{ $order_by_user->discount }}</td>
    <td>{{ $order_by_user->subtotal }}</td>
    <td>
        <a href="{{ url('download/invoice') }}/{{ $order_by_user->id}}" class="btn btn-info" target="_blank">
        Download Invoice
        </a>
        <a href="{{ url('send/invoice') }}/{{ $order_by_user->id}}" class="btn btn-info" target="_blank">
        Send Invoice Via Email
        </a>

    </td>
  </tr>
  @endforeach
</table>
