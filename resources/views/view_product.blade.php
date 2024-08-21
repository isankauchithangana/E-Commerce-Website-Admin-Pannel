<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART View Product</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        @include('menu')

        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <a href="{{ url('products') }}">
                <div class="tatalProductCard">
                    <div class="cardName">View All Products</div>
                    <div class="iconBx">
                        <img width="48" height="48" src="https://img.icons8.com/fluency/48/view.png" alt="view"/>
                    </div>
                </div>  
            </a>
        </div>

        <!-- ================ Product Details ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>{{ $productData->itemName }}</h2>
                </div>

                <label for="itemName">Product Name</label>
                <div class="data-container">
                    <p>{{ $productData->itemName }}</p>
                </div>
                
                <label for="brand">Brand</label>
                <div class="data-container">
                    <p>{{ $productData->brandName }}</p>
                </div>

                <label for="origin">Origin</label>
                <div class="data-container">
                    <p>{{ $productData->origin }}</p>
                </div>

                <label for="availableFrom">Product Available From</label>
                <div class="data-container">
                    <p>{{ $productData->availableFrom }}</p>
                </div>
                
                <label for="availableTo">Product Available To</label>
                <div class="data-container">
                    <p>{{ $productData->availableTo }}</p>
                </div>
            </div>

            <!-- ================= Additional Details ================ -->
            <div class="recentCustomers">
                <div class="categoryRightSide">
                    <label for="category">Category</label>
                    <div class="data-container">
                        <p>{{ $productData->categoryName ?? 'No Category' }}</p>
                    </div>
                    <label for="price">Price (Rs:)</label>
                    <div class="data-container">
                        <p>{{ $productData->price }}</p>
                    </div>

                    <label for="shipping">Shipping</label>
                    <div class="data-container">
                        <p>{{ $productData->shipping }}</p>
                    </div>
                </div>

                <div>
                    <label for="productImage">Product Image</label>
                    <div class="ProductImgContainer">
                        <div class="selecteImgCover">
                            @if($productData->imagePath)
                                <img src="{{asset('images/' .$productData->imagePath)}}" alt="{{ $productData->itemName }}"/>
                            @else
                                <img width="80" height="80" src="https://img.icons8.com/fluency/48/image--v1.png" alt="image--v1"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="{{asset('js/main.js')}}"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
