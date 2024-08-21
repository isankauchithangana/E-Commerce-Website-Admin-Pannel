<?php   
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Admin Login</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

           

            <div class="login-form">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>User Login</h2>
                    </div>


                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" required autofocus>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required> 
                        <input type="submit" name="submit" value="Login">
                    </form>

                    @if($errors->any())
                        <div class="error">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                </div>

               
            </div>
        
    

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>