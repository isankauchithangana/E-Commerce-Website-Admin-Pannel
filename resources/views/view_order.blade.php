<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART View Order</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
    @include('menu')
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <a href="{{ route('orders') }}">
                <div class="tatalProductCard">
                    <div>
                        <div class="cardName">View All orders</div>
                    </div>
                    <div class="iconBx">
                        <img width="48" height="48" src="https://img.icons8.com/fluency/48/view.png" alt="view" />
                    </div>
                </div>
            </a>
        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Order No: 
                        {{ $cartData->cartID }}-{{ $cartData->userID }} {{ $cartData->name }}
                    </h2>
                </div>

                <label for="itemName">Order Number</label>
                <div class="data-container">
                    {{ $cartData->cartID }}-{{ $cartData->userID }} {{ $cartData->name }}
                </div>
                
                <label for="brand">Customer</label>
                <div class="data-container">
                    <p>{{ $cartData->name }}</p>
                </div>

                <label for="origin">Address</label>
                <div class="data-container">
                    <p>{{ $cartData->address }}</p>
                </div>

                <label for="availableTo">Customer NIC</label>
                <div class="data-container">
                    <p>{{ $cartData->nic }}</p>
                </div>

                <label for="availableFrom">Customer Email</label>
                <div class="data-container">
                    <p>{{ $cartData->email }}</p>
                </div>
            </div>

            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="categoryRightSide">
                    <label for="availableFrom">Product</label>
                    <div class="data-container">
                        <p>{{ $cartData->itemName }}</p>
                    </div>

                    <label for="availableFrom">Product ID</label>
                    <div class="data-container">
                        <p>{{ $cartData->itemId }}</p>
                    </div>

                    <label for="category">Quantity</label>
                    <div class="data-container">
                        <p>{{ $cartData->quantity }}</p>
                    </div>
                    <label for="price">Total (Rs:)</label>
                    <div class="data-container">
                        <p>{{ $cartData->price * $cartData->quantity }}</p>
                    </div>
                    <form action="{{ route('orders.updateStatus') }}" method="post">
                        @csrf
                        <input type="hidden" name="cartID" value="{{ $cartData->cartID }}">
                        <label for="status">Status</label>
                        <div class="custom-select-wrapper">
                            <select name="status" class="custom-select">
                                <option value="" disabled selected>{{ $cartData->status }}</option>
                                <option value="Processing">Processing</option>
                                <option value="On Shipping">On Shipping</option>
                                <option value="Delivered">Delivered</option>
                                <option value="ORDERED">Ordered</option>
                            </select>
                        </div>
                        <input type="submit" name="submit" value="Save Status">
                    </form>
                    @if (session('success'))
                        <div class="success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="{{asset('js/main.js')}}"></script>
        <script>
            function uploadFormData(){
                const form = document.getElementById('productForm');
                form.action = '{{ url('php/store_form_data.php') }}';
                form.method = 'post';
                form.submit();
            }

            const buttons = document.querySelectorAll('.categoryBtn');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                });
            });
        </script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
