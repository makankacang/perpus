@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Peminjaman Table</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dikembalikanModal">
                        Buku yang dipinjam
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Buku</th> <!-- Changed to display book name -->
                                <th scope="col">Tanggal Peminjaman</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Status Peminjaman</th>
                                <th scope="col">Action</th> <!-- Add the Action column header -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $peminjaman)
                            @if($peminjaman->StatusPeminjaman === 'konfirmasi' || $peminjaman->StatusPeminjaman === 'dipinjam')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->buku->Judul }}</td> <!-- Displaying book name -->
                                <td>{{ $peminjaman->TanggalPeminjaman }}</td>
                                <td>{{ $peminjaman->TanggalPengembalian }}</td>
                                <td>{{ $peminjaman->StatusPeminjaman }}</td>
                                <td> <!-- Add Action column -->
                                    @if($peminjaman->StatusPeminjaman === 'konfirmasi')
                                        <form action="{{ route('konfirmasiPeminjaman', $peminjaman->PeminjamanID) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Konfirmasi Peminjaman</button>
                                        </form>
                                    @elseif($peminjaman->StatusPeminjaman === 'dipinjam')
                                        <form action="{{ route('kembalikanBuku', $peminjaman->PeminjamanID) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Konfirmasi buku kembali</button>
                                        </form>
                                    @endif
                                </td>                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dikembalikanModal" tabindex="-1" aria-labelledby="dikembalikanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="dikembalikanModalLabel">Peminjaman Table (Dikembalikan)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Buku ID</th>
                                <th scope="col">Tanggal Peminjaman</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Status Peminjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $peminjaman)
                            @if($peminjaman->StatusPeminjaman === 'dikembalikan')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peminjaman->UserID }}</td>
                                <td>{{ $peminjaman->BukuID }}</td>
                                <td>{{ $peminjaman->TanggalPeminjaman }}</td>
                                <td>{{ $peminjaman->TanggalPengembalian }}</td>
                                <td>{{ $peminjaman->StatusPeminjaman }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
