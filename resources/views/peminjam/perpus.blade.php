@extends('layouts.papp')

@section('content')
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Perpustakaan</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active text-white">Perpustakaan</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Koleksi Buku</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="volvo">Nothing</option>
                                        <option value="saab">Popularity</option>
                                        <option value="opel">Organic</option>
                                        <option value="audi">Fantastic</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                                        <span>(3)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                                        <span>(5)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                                        <span>(2)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                                        <span>(8)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                                        <span>(5)</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="mb-2">Price</h4>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                            <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Additional</h4>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                                                <label for="Categories-1"> Organic</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                                                <label for="Categories-2"> Fresh</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                                                <label for="Categories-3"> Sales</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                                                <label for="Categories-4"> Discount</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                                                <label for="Categories-5"> Expired</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="mb-3">Featured products</h4>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-1.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center my-4">
                                            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    @foreach($bukus as $buku)
                                        @php
                                        $isInCollection = in_array($buku->BukuID, $userCollections);
                                        @endphp
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="{{ asset('storage/images/' . $buku->image) }}" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                                    @foreach($buku->kategoris as $kategori)
                                                        {{ $kategori->NamaKategori }}
                                                    @endforeach     
                                                </div>
                                                <div class="text-white px-3 py-1 position-absolute" style="top: 3px; left: 180px;">

                                                    <button type="button" class="btn bg-secondary border border-secondary rounded-pill px-3 text-primary m-1" data-buku-id="{{ $buku->BukuID }}" onclick="toggleCollection('{{ $buku->BukuID }}', {{ $isInCollection ? 'true' : 'false' }})">
                                                        @if($isInCollection)
                                                            <i class="fa fa-check"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    </button>
                                                    

                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $buku->Judul }}</h4>
                                                    <p>{{ $buku->Penulis }}</p>
                                                    <div class="d-flex justify-content-center flex-lg-wrap">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-sm border border-secondary rounded-pill px-3 text-primary m-1" onclick="showBorrowConfirmation('{{ $buku->BukuID }}', '{{ $buku->Judul }}', '{{ $buku->kategoris->implode('NamaKategori', ', ') }}')">
                                                                <i class="fa fa-plus"></i> Pinjam
                                                            </button>
                                                            <button type="button" class="btn btn-sm border border-secondary rounded-pill px-3 text-primary m-1" onclick="showReviewForm('{{ $buku->BukuID }}', '{{ $buku->Judul }}')">
                                                                <i class="far fa-comment"></i> Ulasan
                                                            </button>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
                                    </div>
                                </div>      
                            </div>   
                              
                                <!-- Modal for Borrow Confirmation -->
                                <div class="modal fade" id="borrowConfirmationModal" tabindex="-1" aria-labelledby="borrowConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="borrowConfirmationModalLabel">Konfirmasi Pinjaman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Detail :</h6>
                                                <p>Buku Name: <span id="bukuName"></span></p>
                                                <p>Kategori: <span id="kategori"></span></p>
                                                <p>Tanggal Peminjaman: {{ now()->format('Y-m-d') }}</p>
                                                <form id="borrowForm" action="{{ route('borrow.store') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian:</label>
                                                        <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian" required min="{{ now()->format('Y-m-d') }}">
                                                    </div>                                                    
                                                    <input type="hidden" id="bukuID" name="bukuID">
                                                    <input type="hidden" id="userID" name="userID" value="{{ Auth::user()->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Confirm Borrow</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->

        <script>
            function showBorrowConfirmation(bukuID, bukuName, kategori) {
                document.getElementById('bukuID').value = bukuID;
                document.getElementById('bukuName').textContent = bukuName;
                document.getElementById('kategori').textContent = kategori;
                $('#borrowConfirmationModal').modal('show');
            }
        
            $(document).ready(function() {
                $('#borrowForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    var formData = form.serialize();
                    
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        success: function(response) {
                            // Show success toast
                            showToast('Buku berhasil dipinjam');
                            // Reset the form
                            form.trigger('reset');
                            // Close the modal
                            $('#borrowConfirmationModal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        
            // Function to show a custom toast notification
            function showToast(message) {
                const toastContainer = document.querySelector('.container-fluid'); // Select the container element where you want to append the toast
                const toast = document.createElement('div');
                toast.classList.add('toast');
                toast.classList.add('show');
                toast.classList.add('position-fixed');
                toast.classList.add('top-1');
                toast.classList.add('end-0');
                toast.classList.add('m-4');
                toast.style.opacity = '0'; // Start with opacity 0
                toast.style.transform = 'scale(0.8)'; // Start with a smaller scale
                toast.setAttribute('role', 'alert');
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
        
                const toastBody = document.createElement('div');
                toastBody.classList.add('toast-body');
                toastBody.innerText = message;
        
                toast.appendChild(toastBody);
                toastContainer.appendChild(toast);
        
                // Animate the toast
                setTimeout(() => {
                    toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out'; // Add transition for opacity and transform
                    toast.style.opacity = '1'; // Fade in
                    toast.style.transform = 'scale(1)'; // Scale up
                    setTimeout(() => {
                        toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out'; // Add transition for opacity and transform
                        toast.style.opacity = '0'; // Fade out
                        toast.style.transform = 'scale(0.8)'; // Scale down
                        setTimeout(() => {
                            toast.remove();
                        }, 300); // Remove the toast after animation completes
                    }, 3000); // Display the toast for 3 seconds
                }, 100); // Delay the animation to ensure it starts properly
            }

function toggleCollection(bukuID) {
    // Check if the button has the 'btn-primary' class
    var isInCollection = $('#collectionButton-' + bukuID).hasClass('btn-primary');

    // Determine the action based on the current state
    var action = isInCollection ? 'remove' : 'add';

    $.ajax({
        type: 'POST',
        url: '{{ route('toggle-collection') }}',
        data: {
            bukuID: bukuID,
            action: action,
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            // Show success toast
            showToast('Buku berhasil ' + (action === 'add' ? 'ditambahkan ke koleksi' : 'dihapus dari koleksi'));

            // Toggle the button state
            if (action === 'add') {
                $('#collectionButton-' + bukuID).addClass('btn-primary').removeClass('btn-secondary').html('<i class="fa fa-star"></i> Koleksi');
            } else {
                $('#collectionButton-' + bukuID).removeClass('btn-primary').addClass('btn-secondary').html('<i class="fa fa-check"></i> Tambahkan ke Koleksi');
            }
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}



// Function to show a custom toast notification
function showToast(message) {
    const toastContainer = document.querySelector('.container-fluid'); // Select the container element where you want to append the toast
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.classList.add('show');
    toast.classList.add('position-fixed');
    toast.classList.add('top-1');
    toast.classList.add('end-0');
    toast.classList.add('m-4');
    toast.style.opacity = '0'; // Start with opacity 0
    toast.style.transform = 'scale(0.8)'; // Start with a smaller scale
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');

    const toastBody = document.createElement('div');
    toastBody.classList.add('toast-body');
    toastBody.innerText = message;

    toast.appendChild(toastBody);
    toastContainer.appendChild(toast);

    // Animate the toast
    setTimeout(() => {
        toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out'; // Add transition for opacity and transform
        toast.style.opacity = '1'; // Fade in
        toast.style.transform = 'scale(1)'; // Scale up
        setTimeout(() => {
            toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out'; // Add transition for opacity and transform
            toast.style.opacity = '0'; // Fade out
            toast.style.transform = 'scale(0.8)'; // Scale down
            setTimeout(() => {
                toast.remove();
            }, 300); // Remove the toast after animation completes
        }, 3000); // Display the toast for 3 seconds
    }, 100); // Delay the animation to ensure it starts properly
}

        </script>
        

@endsection