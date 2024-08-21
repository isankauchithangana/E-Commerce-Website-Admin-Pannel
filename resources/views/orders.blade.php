<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Orders</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
    @include('menu')
            <!-- ======================= Cards ================== -->
            <div class="cardBox">

                <a href="#">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                {{$newOrdersCount}}
                            </div>
                            <div class="cardName">New <br> Orders</div>
                        </div>

                        <div class="iconBx">
                            <img width="48" height="48" src="https://img.icons8.com/fluency/48/000000/create-order.png" alt="create-order"/>
                        </div>
                    </div>  
                </a>

                <a href="#">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                {{$processingOrdersCount}}
                            </div>
                            <div class="cardName">Processing </br>Orders</div>
                        </div>

                        <div class="iconBx">
                            <img width="48" height="48" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/external-processing-3d-printing-flaticons-lineal-color-flat-icons.png" alt="external-processing-3d-printing-flaticons-lineal-color-flat-icons"/>                        
                        </div>
                    </div>  
                </a>

                <a href="#">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                {{$onShippingOrdersCount}}
                            </div>
                            <div class="cardName">On <br> Shipping</div>
                        </div>

                        <div class="iconBx">
                        <img width="48" height="48" src="https://img.icons8.com/color/48/delivery--v1.png" alt="delivery--v1"/>                        
                        </div>
                    </div>  
                </a>

                <a href="#">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                {{$deliveredOrdersCount}}
                            </div>
                            <div class="cardName">Delivered  </br>Orders</div>
                        </div>

                        <div class="iconBx">
                            <img width="48" height="48" src="https://img.icons8.com/color/48/checked-truck.png" alt="checked-truck"/>                        
                        </div>
                        </div>  
                </a>
                
               
            </div>
            

                <!-- =================  Customers ================ -->
                <div class="viewProducts">
                    <div class="cardHeader">
                        <h2>Current Orders </h2>
                    </div>

                    <table>
                    <thead>
                            <tr>
                                <td>Order</td>
                                <td>View</td>
                                <td>Status</td>
                                <td>Item</td>
                                <td>Address</td>
                                <td>Total</td>
                                <td>Payment</td>                               
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <h4># {{ $order->cartID }}-{{ $order->userID }} {{ $order->name }}</h4> 
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->cartID) }}" class="btn4"><ion-icon name="eye-outline"></ion-icon></a>
                                    </td>
                                    <td>
                                        <p>{{ $order->status }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $order->itemName }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $order->address }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $order->quantity * $order->price }}</p>
                                    </td>
                                    <td>
                                        <p>Direct Bank</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/main.js')}}"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>