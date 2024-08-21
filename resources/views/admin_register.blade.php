<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Super Admin Register</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
</head>

<body>
    <div class="login-form">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Super Admin Register</h2>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

                <form action="{{ route('admin.save') }}" method="post">
                    @csrf
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" required>

                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" required>

                    <label for="NIC">NIC Number</label>
                    <input type="text" name="NIC" required>

                    <label for="email">Email</label>
                    <input type="text" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" required>

                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" required>

                    <label for="address">Address</label>
                    <input type="text" name="address">

                    <label for="pNo">Phone Number</label>
                    <input type="text" name="pNo">

                    <label for="joinDate">Join Date</label>
                    <input type="date" name="joinDate">

                    <input type="submit" name="submit" value="Create Super Admin">
                </form>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
