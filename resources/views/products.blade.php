<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Products</title>
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
                           <div class="numbers"> {{ $productCount }} </div>
                           
                            <div class="cardName">Total Products</div>
                        </div>

                        <div class="iconBx">
                        <img src="https://img.icons8.com/fluency/48/fast-moving-consumer-goods.png" alt="fast-moving-consumer-goods"/>
                        </div>
                    </div>  
                </a>
                
                <a href="{{ route('product.create') }}">
                    <div class="addNewUserCard">
                        <div>
                            <div class="cardName">Add New Product</div>
                        </div>

                        <div class="iconBx">
                            <img src="https://img.icons8.com/parakeet/48/add.png" alt="add"/>
                        </div>
                    </div>  
                </a>
            </div>
            

                <!-- =================  Customers ================ -->
                <div class="viewProducts">
                    <div class="cardHeader">
                        <h2>All Products </h2>
                        <a href="{{ route('product.create') }}" class="btn3"><ion-icon name="add-circle-outline"></ion-icon></a>
                    </div>

                    <table>
                    <thead>
                            <tr>
                                <td>image</td>
                                <td>Name</td>
                                <td>Price(RS:)</td>
                                <td>Category</td>
                                <td>Brand</td>
                                <td>View</td>                               
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td width="60px">
                                        <div class="productimgBx"><img src="{{asset('images/' .$product->imagePath)}}" alt=""></div>
                                    </td>
                                    <td>
                                        <h4>{{ $product->itemName }}</h4> 
                                    </td>
                                    <td>
                                        <p>{{ $product->price }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $product->categoryName }}</p> 
                                    </td>
                                    <td>
                                        <p>{{ $product->brandName }}</p> 
                                    </td>
                                    <td>
                                        <a href="{{ route('product.show', $product->itemId) }}" class="btn4"><ion-icon name="eye-outline"></ion-icon></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->itemId) }}" class="btn1"><ion-icon name="create-outline"></ion-icon></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('product.delete', $product->itemId) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 6px; text-decoration: none; border-radius: 5px; color: var(--white); border: none; background-color: var(--red); cursor: pointer;">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </form>                                    
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