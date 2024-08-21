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
                        <div class="numbers">{{ $adminCount }}</div>
                        <div class="cardName">Admins</div>
                    </div>
                    <div class="iconBx">
                        <img src="https://img.icons8.com/color/48/admin-settings-male.png" alt="admin-settings-male"/>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $storeManagerCount }}</div>
                        <div class="cardName">Store Managers</div>
                    </div>
                    <div class="iconBx">
                        <img src="https://img.icons8.com/color/48/storekeeper.png" alt="storekeeper"/>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $contentEditorCount }}</div>
                        <div class="cardName">Content Editors</div>
                    </div>
                    <div class="iconBx">
                        <img src="https://img.icons8.com/color/48/content.png" alt="content"/>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $deliveryPersonalCount }}</div>
                        <div class="cardName">Delivery Personnels</div>
                    </div>
                    <div class="iconBx">
                        <img width="50" height="50" src="https://img.icons8.com/external-nawicon-outline-color-nawicon/64/external-delivery-man-delivery-nawicon-outline-color-nawicon.png" alt="external-delivery-man"/>
                    </div>
                </div>
            </a>

            <a href="{{ route('create_user') }}">
                <div class="addNewUserCard">
                    <div>
                        <div class="cardName">Add New User</div>
                    </div>
                    <div class="iconBx">
                        <img src="https://img.icons8.com/parakeet/48/add.png" alt="add"/>
                    </div>
                </div>  
            </a>
        </div>

        <!-- =================  Customers ================ -->
        <div class="viewUsers">
            <div class="cardHeader">
                <h2>Current Users</h2>
                <a href="{{ route('create_user') }}" class="btn3"><ion-icon name="add-circle-outline"></ion-icon></a>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Profile</td>
                        <td>Name</td>
                        <td>NIC</td>
                        <td>Email</td>
                        <td>Mobile</td>
                        <td>Address</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="{{asset('images/imgs/customer02.png')}}" alt=""></div>
                            </td>
                            <td>
                                <h4>{{ $employee->firstName }}</h4> 
                            </td>
                            <td>
                                <p>{{ $employee->NIC }}</p> 
                            </td>
                            <td>
                                <p>{{ $employee->email }}</p> 
                            </td>
                            <td>
                                <p>{{ $employee->pNo }}</p> 
                            </td>
                            <td>
                                <p>{{ $employee->address }}</p> 
                            </td>
                            <td>
                                <a href="" class="btn1"><ion-icon name="create-outline"></ion-icon></a>
                            </td>
                            <td>
                                <a href="" class="btn2"><ion-icon name="trash-outline"></ion-icon></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
