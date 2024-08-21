<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Create Users</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <div class="container">
        @include('menu')

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
                        <div class="numbers">{{ $deliveryPersonCount }}</div>
                        <div class="cardName">Delivery Personnels</div>
                    </div>
                    <div class="iconBx">
                        <img width="50" height="50" src="https://img.icons8.com/external-nawicon-outline-color-nawicon/64/external-delivery-man-delivery-nawicon-outline-color-nawicon.png" alt="external-delivery-man"/>
                    </div>
                </div>
            </a>
        </div>

        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Create New User</h2>
                </div>

                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    @if($errors->any())
                        <div class="error">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" value="{{ old('firstName') }}" required>

                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" value="{{ old('lastName') }}" required>
                    
                    <label for="nic">NIC Number</label>
                    <input type="text" name="nic" value="{{ old('nic') }}" required>

                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" required>

                    <label for="pNo">Mobile Number</label>
                    <input type="text" name="pNo" value="{{ old('pNo') }}" required>

                    <label for="joinDate">Date Of Join</label>
                    <input type="date" name="joinDate" value="{{ old('joinDate') }}" required>

                    <label for="role">User Role</label>
                    <div class="custom-select-wrapper">
                        <select name="role" class="custom-select" required>
                            <option value="" disabled selected>Select the Role</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Store Manager" {{ old('role') == 'Store Manager' ? 'selected' : '' }}>Store Manager</option>
                            <option value="Content Editor" {{ old('role') == 'Content Editor' ? 'selected' : '' }}>Content Editor</option>
                            <option value="Delivery Personal" {{ old('role') == 'Delivery Personal' ? 'selected' : '' }}>Delivery Personal</option>
                        </select>
                    </div>

                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" required>

                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" required> 
                    
                    <input type="submit" name="submit" value="Create User">
                </form>
            </div>

            <div class="recentCustomers">
                <div>
                    <div class="cardHeader">
                        <h2>Current Users</h2>
                    </div>

                    <table>
                        @foreach($employees as $employee)
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="{{asset('images/imgs/customer02.png')}}" alt=""></div>
                                </td>
                                <td>
                                    <h4>{{ $employee->firstName }}<br> <span>{{ $employee->userRole }}</span></h4>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/main.js')}}"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
