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
                <h1 class="mb-4">Buku</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" id="searchInput" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="sort">Default Sorting:</label>
                                    <select id="sort" name="sorting" class="border-0 form-select-sm bg-light me-3">
                                        <option value="title-asc">Title (A-Z)</option>
                                        <option value="title-desc">Title (Z-A)</option>
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
                                                @foreach($categories as $category)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('peminjam.perpus', ['kategori' => $category->KategoriID]) }}">
                                                            <i class="fas fa-apple-alt me-2"></i>{{ $category->NamaKategori }}
                                                        </a>
                                                        <span>({{ $category->bukus->count() }})</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    @foreach($bukus as $buku)
                                    @php
                                    $isBorrowed = \App\Models\Peminjaman::where('BukuID', $buku->BukuID)
                                                    ->where('UserID', Auth::user()->id)
                                                    ->whereIn('StatusPeminjaman', ['konfirmasi', 'dipinjam'])
                                                    ->exists();
                                    $isBorroweds = \App\Models\Peminjaman::where('BukuID', $buku->BukuID)
                                                    ->where('UserID', Auth::user()->id)
                                                    ->whereIn('StatusPeminjaman', ['dipinjam', 'dikembalikan'])
                                                    ->exists();
                                    $isInCollection = in_array($buku->BukuID, $userCollections);
                            
                                    // Check if the user has provided a review for this book
                                    $userReview = \App\Models\UlasanBuku::where('BukuID', $buku->BukuID)
                                                    ->where('UserID', Auth::user()->id)
                                                    ->first();
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
                                                    @if($isInCollection)
                                                        <button id="addToCollectionBtn_{{ $buku->BukuID }}" type="button" class="btn bg-secondary border border-secondary rounded-pill px-3 text-primary m-1" onclick="removeFromCollection('{{ $buku->BukuID }}')">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    @else
                                                            <button id="addToCollectionBtn_{{ $buku->BukuID }}" type="button" class="btn bg-secondary border border-secondary rounded-pill px-3 text-primary m-1" onclick="addToCollection('{{ $buku->BukuID }}')">
                                                                <i class="fa fa-star"></i>
                                                            </button>
                                                    @endif
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $buku->Judul }}</h4>
                                                    <p>{{ $buku->Penulis }}</p>
                                                    <div class="d-flex justify-content-center flex-lg-wrap">
                                                        <div class="btn-group" role="group">
                                                            @if(!$isBorrowed)
                                                                <button type="button" class="btn btn-md border border-secondary rounded-pill px-3 text-primary m-1" onclick="showBorrowConfirmation('{{ $buku->BukuID }}', '{{ $buku->Judul }}', '{{ $buku->kategoris->implode('NamaKategori', ', ') }}')">
                                                                    <i class="fa fa-plus"></i> Pinjam
                                                                </button>
                                                                @else
                                                                <button type="button" class="btn btn-md border border-secondary rounded-pill px-3 text-primary m-1" disabled>
                                                                    <i class="fa fa-check"></i> Dipinjam
                                                                </button>
                                                            @endif
                                                            @if($isBorroweds)
                                                            @if($userReview)
                                                                <!-- If user has already provided a review -->
                                                                <button type="button" class="btn btn-md border border-secondary rounded-pill px-3 text-primary m-1" onclick="editReview('{{ $buku->BukuID }}', '{{ $buku->Judul }}')">
                                                                    <i class="far fa-comment"></i> Edit Ulasan
                                                                </button>
                                                            @else
                                                                <!-- If user has not provided a review -->
                                                                <button type="button" class="btn btn-md border border-secondary rounded-pill px-3 text-primary m-1" onclick="showReviewForm('{{ $buku->BukuID }}', '{{ $buku->Judul }}')">
                                                                    <i class="far fa-comment"></i> Ulasan
                                                                </button>
                                                            @endif
                                                            @endif                                    
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12">
                                    {{ $bukus->links() }}
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
                                                        <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian" required min="{{ now()->format('Y-m-d') }}" max="{{ now()->addWeeks(3)->format('Y-m-d') }}">
                                                    </div>                                                    
                                                    <input type="hidden" id="bukuID" name="bukuID">
                                                    <input type="hidden" id="userID" name="userID" value="{{ Auth::user()->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" id="confirmBorrowBtn">Confirm Borrow</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                        <!-- Modal for Review Form -->
                                        <div class="modal fade" id="reviewFormModal" tabindex="-1" aria-labelledby="reviewFormModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reviewFormModalLabel">Beri Ulasan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="reviewForm" action="{{ route('review.store') }}" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="rating">Rating:</label>
                                                                <div id="rating"></div>
                                                                <input type="hidden" name="rating" id="rating_input">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="ulasan">Ulasan:</label>
                                                                <textarea class="form-control" id="ulasan" name="ulasan" rows="3"></textarea>
                                                            </div>
                                                            <input type="hidden" name="bukuID" id="bukuID_input">
                                                            <input type="hidden" name="userID" id="userID_input" value="{{ Auth::user()->id }}">
                                                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                                        </form>
                                                        <hr>
                                                        <h5>Ulasan Lainnya</h5>
                                                        <ul id="otherReviewsList"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal for Edit Review Form -->
                                        <div class="modal fade" id="editReviewFormModal" tabindex="-1" aria-labelledby="editReviewFormModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editReviewFormModalLabel">Edit Ulasan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editReviewForm" action="{{ route('review.update') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="editRating">Rating:</label>
                                                                <div id="editRating"></div>
                                                                <input type="hidden" name="rating" id="editRating_input">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editUlasan">Ulasan:</label>
                                                                <textarea class="form-control" id="editUlasan" name="ulasan" rows="3"></textarea>
                                                            </div>
                                                            <input type="hidden" name="bukuID" id="editBukuID_input">
                                                            <input type="hidden" name="userID" id="editUserID_input" value="{{ Auth::user()->id }}">
                                                            <button type="submit" class="btn btn-primary">Update Ulasan</button>
                                                        </form>
                                                        <hr>
                                                        <h5>Ulasan Lainnya:</h5>
                                                        <div id="otherReviews"></div>
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
                // Update the button state
                $('#confirmBorrowBtn').attr('disabled', true).html('Dipinjam').addClass('disabled');

                // Reload the page without changing the scroll position
                var scrollPosition = window.scrollY || window.pageYOffset;
                location.reload();
                window.scrollTo(0, scrollPosition);
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

            function addToCollection(bukuID) {
    $.ajax({
        type: 'POST',
        url: '{{ route('add-to-collection') }}',
        data: {
            bukuID: bukuID,
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            // Update button icon to 'fa-check'
            $('#addToCollectionBtn_' + bukuID + ' .fa').removeClass('fa-star').addClass('fa-check');
            // Change the onclick function to call removeFromCollection
            $('#addToCollectionBtn_' + bukuID).attr('onclick', 'removeFromCollection(\'' + bukuID + '\')');
            // Show success toast or update UI
            showToast('Buku berhasil ditambahkan ke koleksi');
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

function removeFromCollection(bukuID) {
    $.ajax({
        type: 'POST',
        url: '{{ route('remove-from-collection') }}',
        data: {
            bukuID: bukuID,
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            // Update button icon to 'fa-star'
            $('#addToCollectionBtn_' + bukuID + ' .fa').removeClass('fa-check').addClass('fa-star');
            // Change the onclick function to call addToCollection
            $('#addToCollectionBtn_' + bukuID).attr('onclick', 'addToCollection(\'' + bukuID + '\')');
            // Show success toast or update UI
            showToast('Buku berhasil dihapus dari koleksi');
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

function showReviewForm(bukuID, judul) {
    $('#bukuID_input').val(bukuID);
    $('#reviewFormModal').modal('show');
    $('#rating').rateYo({
        rating: 0,
        fullStar: true,
        onChange: function (rating, rateYoInstance) {
            $('#rating_input').val(rating);
        }
    });

    // Fetch other users' reviews for the specified book
    $.ajax({
        type: 'GET',
        url: '{{ route('review.other') }}',
        data: {
            bukuID: bukuID,
        },
        success: function(response) {
            var otherReviews = response.otherReviews;
            var reviewList = $('#otherReviewsList');
            reviewList.empty(); // Clear existing reviews
            if (otherReviews.length > 0) {
                otherReviews.forEach(function(review) {
                    var listItem = $('<li>').text('Rating: ' + review.Rating + ', Ulasan: ' + review.Ulasan);
                    reviewList.append(listItem);
                });
            } else {
                reviewList.append($('<li>').text('No other reviews available.'));
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


$(document).ready(function() {
    $('#reviewForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();
        
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                // Close the modal
                $('#reviewFormModal').modal('hide');
                // Show success toast
                showToast('Ulasan berhasil dikirim');
                // Reset the form
                form.trigger('reset');
                // Reload the page without changing the scroll position
                var scrollPosition = window.scrollY || window.pageYOffset;
                location.reload();
                window.scrollTo(0, scrollPosition);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});

function editReview(bukuID, judul) {
    // Fetch the user's existing review for the book via AJAX
    $.ajax({
        type: 'GET',
        url: '{{ route('review.edit') }}',
        data: {
            bukuID: bukuID,
            userID: '{{ Auth::user()->id }}',
        },
        success: function(response) {
            // Populate the modal fields with the existing review data
            $('#editRating').rateYo('rating', response.rating); // Populate rating
            $('#editUlasan').val(response.ulasan); // Populate ulasan
            $('#editBukuID_input').val(bukuID); // Set book ID
            // Show the modal
            $('#editReviewFormModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    // Initialize RateYo for rating input
    $("#editRating").rateYo({
        rating: 0,
        starWidth: "20px",
        readOnly: false,
        ratedFill: "#ffc929",
        fullStar: true,
        onChange: function (rating, rateYoInstance) {
            $('#editRating_input').val(rating); // Set the value of the hidden input field
        }
    });

    // Submit edit review form via AJAX
    $('#editReviewForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'PUT',
            url: url,
            data: formData,
            success: function(response) {
                // Show success toast
                showToast('Ulasan berhasil diperbarui');
                // Reset the form
                form.trigger('reset');
                // Close the modal
                $('#editReviewFormModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

// Function to fetch other users' reviews
function fetchOtherReviews(bukuID) {
    $.ajax({
        type: 'GET',
        url: '{{ route('review.other') }}',
        data: {
            bukuID: bukuID
        },
        success: function(response) {
            $('#otherReviews').empty(); // Clear existing content
            if (response.otherReviews.length > 0) {
                response.otherReviews.forEach(function(review) {
                    var html = '<div class="mb-3">';
                    html += '<p><strong>Rating:</strong> ' + review.rating + '</p>';
                    html += '<p><strong>Ulasan:</strong> ' + review.ulasan + '</p>';
                    html += '</div>';
                    $('#otherReviews').append(html);
                });
            } else {
                $('#otherReviews').html('<p>Tidak ada ulasan lain untuk buku ini.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$('#editReviewFormModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var bukuID = button.data('bukuid'); // Extract bukuID from data-* attributes

    // Fetch other users' reviews
    fetchOtherReviews(bukuID);
});

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    if (searchInput) { // Check if search input element exists
        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const books = document.querySelectorAll('.col-md-6');

            books.forEach(function (book) {
                const titleElement = book.querySelector('h4');
                if (titleElement) {
                    const title = titleElement.textContent.toLowerCase();
                    if (title.includes(searchTerm)) {
                        book.style.display = 'block';
                    } else {
                        book.style.display = 'none';
                    }
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('sort');

    if (selectElement) {
        selectElement.addEventListener('change', function () {
            const selectedOption = selectElement.value;
            const booksContainer = document.querySelector('.row.g-4');

            // Get all book cards
            const books = Array.from(booksContainer.children);

            // Sort the book cards based on the selected option
            switch (selectedOption) {
                case 'title-asc':
                    books.sort((a, b) => {
                        const titleA = a.querySelector('h4').textContent.toLowerCase();
                        const titleB = b.querySelector('h4').textContent.toLowerCase();
                        return titleA.localeCompare(titleB);
                    });
                    break;
                case 'title-desc':
                    books.sort((a, b) => {
                        const titleA = a.querySelector('h4').textContent.toLowerCase();
                        const titleB = b.querySelector('h4').textContent.toLowerCase();
                        return titleB.localeCompare(titleA);
                    });
                    break;
                default:
                    // No sorting needed for other options
                    break;
            }

            // Remove existing book cards from the container
            while (booksContainer.firstChild) {
                booksContainer.removeChild(booksContainer.firstChild);
            }

            // Add sorted book cards back to the container
            books.forEach(function (book) {
                booksContainer.appendChild(book);
            });
        });
    }
});


        </script>
        

@endsection