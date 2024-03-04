@extends('layouts.papp')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Koleksi saya</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Koleksi</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="row g-4 justify-content-center">
                @foreach($koleksis as $koleksipribadi)
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="rounded position-relative fruite-item">
                            <div class="fruite-img">
                                <img src="{{ asset('storage/images/' . $koleksipribadi->buku->image) }}" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                @foreach($koleksipribadi->buku->kategoris as $kategori)
                                    {{ $kategori->NamaKategori }}
                                @endforeach
                                <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary m-1" onclick="removeFromCollection('{{ $koleksipribadi->KoleksiID }}')">
                                    <i class="fa fa-times me-2 text-primary"></i> Remove
                                </button>     
                            </div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4>{{ $koleksipribadi->buku->Judul }}</h4>
                                <p>{{ $koleksipribadi->buku->Penulis }}</p>
                                <div class="d-flex justify-content-center flex-lg-wrap">
                                    <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary m-1" onclick="showBorrowConfirmation('{{ $koleksipribadi->buku->BukuID }}', '{{ $koleksipribadi->buku->Judul }}', '{{ $koleksipribadi->buku->kategoris->implode('NamaKategori', ', ') }}')">
                                        <i class="fa fa-plus me-2 text-primary"></i> Pinjam buku
                                    </button>                                                        
                                    <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary m-1">
                                        <i class="fa fa-pencil-square me-2 text-primary"></i> Ulasan
                                    </button>                                                                                                             
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
        
    </div>
</div>
@endsection
