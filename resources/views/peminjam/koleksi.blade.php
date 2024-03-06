@extends('layouts.papp')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Koleksi saya</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Me</li>
        <li class="breadcrumb-item active text-white">Koleksi</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Koleksi Saya</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" id="searchInput" class="form-control p-3" placeholder="Search keywords" aria-describedby="search-icon-1">
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
                                        @foreach($categories as $category)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="{{ route('peminjam.koleksi', ['kategori' => $category->KategoriID]) }}"><i class="fas fa-apple-alt me-2"></i>{{ $category->NamaKategori }}</a>
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
                        <div class="row g-4 justify-content-center" id="koleksiContainer">
                            @foreach($koleksis as $koleksipribadi)
                                <div class="col-md-6 col-lg-6 col-xl-4" id="koleksiCard_{{ $koleksipribadi->KoleksiID }}">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="{{ asset('storage/images/' . $koleksipribadi->buku->image) }}" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                            @foreach($koleksipribadi->buku->kategoris as $kategori)
                                                {{ $kategori->NamaKategori }}
                                            @endforeach     
                                        </div>
                                        <div class="text-white px-3 py-1 position-absolute" style="top: 3px; left: 185px;">
                                            <button type="button" class="btn bg-secondary border border-secondary rounded-pill px-3 text-primary m-1" onclick="removeFromCollection('{{ $koleksipribadi->KoleksiID }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                        
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $koleksipribadi->buku->Judul }}</h4>
                                            <p>{{ $koleksipribadi->buku->Penulis }}</p>
                                            <div class="d-flex justify-content-center flex-lg-wrap">
                                                <div class="btn-group" role="group">
                                                    @php
                                                        $isBookBorrowed = \App\Models\Peminjaman::where('UserID', Auth::user()->id)
                                                            ->where('BukuID', $koleksipribadi->buku->BukuID)
                                                            ->whereIn('StatusPeminjaman', ['konfirmasi', 'dipinjam'])
                                                            ->exists();
                                                    @endphp
                                                    @if($isBookBorrowed)
                                                    <button type="button" class="btn btn-sm border border-secondary rounded-pill px-3 text-primary m-1" disabled>
                                                        <i class="fa fa-check"></i> Dipinjam
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-sm border border-secondary rounded-pill px-3 text-primary m-1" onclick="showBorrowConfirmation('{{ $koleksipribadi->buku->BukuID }}', '{{ $koleksipribadi->buku->Judul }}', '{{ $koleksipribadi->buku->kategoris->implode('NamaKategori', ', ') }}')">
                                                        <i class="fa fa-plus"></i> Pinjam
                                                    </button>
                                                    @endif

                                                    <button type="button" class="btn btn-sm border border-secondary rounded-pill px-3 text-primary m-1" onclick="showReviewForm('{{ $koleksipribadi->buku->BukuID }}', '{{ $koleksipribadi->buku->Judul }}')">
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
                                                <button type="submit" class="btn btn-primary" id="confirmBorrowBtn">Confirm Borrow</button>
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
                var scrollPosition = window.scrollY || window.pageYOffset;
                location.reload();
                window.scrollTo(0, scrollPosition);

                // Reset the form
                form.trigger('reset');
                // Close the modal
                $('#borrowConfirmationModal').modal('hide');
                // Update the button state
                $('#confirmBorrowBtn').attr('disabled', true).html('Dipinjam').addClass('disabled');

                // Show success toast after reload
                setTimeout(function() {
                    showToast('Buku berhasil dipinjam');
                }, 500); // Adjust delay as needed
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});



function removeFromCollection(koleksiID) {
    $.ajax({
        type: 'POST',
        url: '{{ route('remove-from-collections') }}',
        data: {
            koleksiID: koleksiID,
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            console.log(response); // Log the response to check if it's successful
            if (response.success) {
                // Fade out and then remove the koleksipribadi item from the UI
                $('#koleksiCard_' + koleksiID).fadeOut(500, function() {
                    $(this).remove();
                });
                // Show success toast or update UI
                showToast('Buku dihapus dari koleksi');
            } else {
                // Handle case when removal was not successful
                console.error('Error removing item from collection:', response.message);
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

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const koleksiContainer = document.getElementById('koleksiContainer');

        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.toLowerCase().trim();

            // Loop through each koleksipribadi item and check if it matches the search text
            Array.from(koleksiContainer.children).forEach(function (koleksiItem) {
                const title = koleksiItem.querySelector('h4').textContent.toLowerCase();
                const author = koleksiItem.querySelector('p').textContent.toLowerCase();
                const isVisible = title.includes(searchText) || author.includes(searchText);
                koleksiItem.style.display = isVisible ? 'block' : 'none';
            });
        });
    });
</script>


@endsection
