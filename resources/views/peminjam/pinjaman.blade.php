@extends('layouts.papp')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Peminjaman ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Buku ID</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->PeminjamanID }}</td>
                        <td>{{ $peminjaman->UserID }}</td>
                        <td>{{ $peminjaman->BukuID }}</td>
                        <td>{{ $peminjaman->TanggalPeminjaman }}</td>
                        <td>{{ $peminjaman->TanggalPengembalian }}</td>
                        <td>
                            @if($peminjaman->StatusPeminjaman === 'konfirmasi')
                                <span class="badge bg-warning"> <i class="fa fa-clock text-white"></i> Menunggu Konfirmasi</span>
                                    <button class="btn btn-md rounded-pill bg-light border m-1">
                                        <i class="fa fa-times text-danger"></i> Batal meminjam
                                    </button>
                            @elseif($peminjaman->StatusPeminjaman === 'dipinjam')
                                <span class="badge bg-success"> <i class="fa fa-handshake text-white"></i> Sedang Dipinjam</span>
                            @elseif($peminjaman->StatusPeminjaman === 'dikembalikan')
                                <span class="badge bg-info"> <i class="fa fa-check-circle text-white"></i> Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection
