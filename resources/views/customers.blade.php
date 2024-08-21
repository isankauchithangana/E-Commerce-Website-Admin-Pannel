<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART View Users</title>
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
                            {{$customerCount}}
                            </div>
                            <div class="cardName">Total Customers</div>
                        </div>

                        <div class="iconBx">
                        <img width="48" height="48" src="https://img.icons8.com/avantgarde/100/gender-neutral-user.png" alt="gender-neutral-user"/>
                        </div>
                    </div>
               </a>
                
            </div>
            

                <!-- =================  Customers ================ -->
                <div class="viewUsers">
                    <div class="cardHeader">
                        <h2>All Customers</h2>
                        <a href="#" class="btn3"><ion-icon name="add-circle-outline"></ion-icon></a>
                    </div>

                    <table>
                    <thead>
                            <tr>
                                <td>User Id</td>
                                <td>Profile</td>
                                <td>Name</td>
                                <td>NIC</td>
                                <td>Address</td>
                                <td>Email</td>
                                <td>View</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>
                                        <h4># {{ $customer->userID }}</h4> 
                                    </td>
                                    <td width="60px">
                                        <div class="imgBx"><img src="{{asset('images/imgs/customer02.png')}}" alt=""></div>
                                    </td>
                                    <td>
                                        <h4>{{ $customer->name }}</h4> 
                                    </td>
                                    <td>
                                        <p>{{ $customer->nic }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $customer->address }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $customer->email }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn1"><ion-icon name="create-outline"></ion-icon></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn2"><ion-icon name="trash-outline"></ion-icon></a>
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