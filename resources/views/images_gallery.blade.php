<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A MART Image Gallery</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        @include('partials.menu') 
        
        <!-- ======================= Cards ================== -->
        <div class="new_img_import">
            <div class="successMsg">
                @if(session('success'))
                    <div class="success">{{ session('success') }}</div>
                @endif
            </div>
            <div class="drag-area">
                <p>Drag & Drop to Upload File</p>
                <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="fileInput" name="fileInput[]" multiple style="display: none;" required>
                    <button type="button" id="selectButton">Select Image</button>
            </div>
            <div class="upload_img">
                <div class="new-images" id="newImages"></div>
                <div class="submit-button">
                    <input type="submit" name="submit" value="Save Image To Gallery">
                </div>
                </form>
            </div>
        </div>
       
        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Image Gallery</h2>
                </div>

                <div class="imgGallery">
                    @foreach($images as $image)
                        <div class="gallery">
                            <img src="{{ asset($image->imagePath) }}" data-id="{{ $image->imageID }}" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="categoryRightSide">
                    <label for="productImage">Preview</label>
                    <div class="selectedImg">
                        <div class="selecteImgCover">
                            <img src="https://img.icons8.com/fluency/100/image--v1.png" alt="image--v1"/>
                        </div>

                        <form action="{{ route('product.saveImageSelection') }}" method="post" id="redirectForm">
                            @csrf
                            @if(session('itemID'))
                                <input type="hidden" name="itemID" value="{{ session('itemID') }}">
                            @endif
                            <input type="hidden" name="imageID" id="imageID">
                            <button type="button" class="img_upload" name="selectImageButton" id="selectImageButton">
                                Select Image
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const dragArea = document.querySelector('.drag-area');
        const fileInput = document.getElementById('fileInput');
        const selectButton = document.getElementById('selectButton');
        const newImagesContainer = document.getElementById('newImages');
        const submitButton = document.querySelector('.submit-button');
        const imageIDInput = document.getElementById('imageID');
        const redirectForm = document.getElementById('redirectForm');
        const selectImageButton = document.getElementById('selectImageButton');

        selectButton.addEventListener('click', () => {
            fileInput.click();
        });

        dragArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dragArea.classList.add('hover');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('hover');
        });

        dragArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dragArea.classList.remove('hover');
            const files = event.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', () => {
            const files = fileInput.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            newImagesContainer.innerHTML = ''; 
            let hasImages = false;
            for (const file of files) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = (event) => {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    newImagesContainer.appendChild(img);
                    hasImages = true;
                    toggleSubmitButton(hasImages);
                };
            }
        }

        function toggleSubmitButton(hasImages) {
            if (hasImages) {
                submitButton.style.display = 'block';
            } else {
                submitButton.style.display = 'none';
            }
        }

        document.querySelectorAll('.gallery img').forEach(img => {
            img.addEventListener('click', function() {
                document.querySelector('.selectedImg img').src = this.src;
                imageIDInput.value = this.dataset.id;
            });
        });

        selectImageButton.addEventListener('click', () => {
            if (imageIDInput.value) {
                redirectForm.submit();
            } else {
                alert('Please select an image.');
            }
        });
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
