@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Koleksi Pribadi Table</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">UserID</th>
                                <th scope="col">BukuID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($koleksiPribadi as $koleksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <form action="/koleksiPribadi/edit/{{ $koleksi->KoleksiID }}" method="POST">
                                    @csrf
                                    <td>{{ $koleksi->UserID }}</td>
                                    <td>{{ $koleksi->BukuID }}</td>
                                    <td>
                                        <button type="submit" class="btn text-success save-btn" style="display: none;">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                        <div class="btn-group" style="display: none;">
                                            <p class="text-white mb-0">Are you sure?</p>
                                            <a href="/koleksidelete/{{ $koleksi->KoleksiID }}" class="btn btn-danger confirm-delete-btn">Yes</a>
                                            <button class="btn btn-outline-danger cancel-delete-btn">Cancel</button>
                                        </div>                             
                                    </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    document.querySelectorAll('.cancel-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            const saveButton = row.querySelector('.save-btn');
            const editButton = row.querySelector('.edit-btn');
            const deleteButton = row.querySelector('.delete-btn');
            const confirmDeleteButton = row.querySelector('.confirm-delete-btn');

            saveButton.style.display = 'none';
            button.style.display = 'none';
            editButton.style.display = 'inline-block';
            deleteButton.style.display = 'inline-block';
            confirmDeleteButton.parentNode.style.display = 'none'; // Hide confirm delete button group
        });
    });

    document.querySelectorAll('.delete-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            const confirmDeleteButton = row.querySelector('.confirm-delete-btn');
            const deleteButton = row.querySelector('.delete-btn');
            const editButton = row.querySelector('.edit-btn'); // Get the edit button

            deleteButton.style.display = 'none'; // Hide delete button
            editButton.style.display = 'none'; // Hide edit button
            confirmDeleteButton.parentNode.style.display = 'inline-block'; // Show confirm delete button group
        });
    });

    document.querySelectorAll('.cancel-delete-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            const deleteButton = row.querySelector('.delete-btn');
            const confirmDeleteButton = row.querySelector('.confirm-delete-btn');
            const editButton = row.querySelector('.edit-btn'); // Get the edit button

            confirmDeleteButton.parentNode.style.display = 'none'; // Hide confirm delete button group
            deleteButton.style.display = 'inline-block'; // Show delete button
            editButton.style.display = 'inline-block'; // Show edit button
        });
    });
</script>

@endsection
