@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>User Management</h2>
        <div class="card card-table mt-3">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <form method="get" action="{{ route('user.index') }}" class="d-flex">
                        <input type="text" class="form-control me-3" name="keyword" placeholder="Cari user..." value="{{ request()->keyword }}"/>
                        <button type="submit" class="btn theme-bg-color btn-sm text-white fw-bold mend-auto">Cari</button>
                    </form>

                    <div class="right-options">
                        <ul>
                            <li>
                                <a class="btn theme-bg-color btn-sm text-white fw-bold mend-auto" type="button" href="{{ route('user.create') }}">Tambah User</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Alamat Email</th>
                                    <th class="text-start">No HP</th>
                                    <th class="text-start">Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $index => $user)
                                <tr>
                                    <td class="text-start">{{ $user->name }}</td>
                                    <td class="text-start">{{ $user->email }}</td>
                                    <td class="text-start">{{ $user->phone ?: '-' }}</td>
                                    <td class="text-start">{{ $user->role_name }}</td>

                                    <td>
                                        <a href="{{ route('user.edit', ['user' => $user->id]) }}">
                                            <i class="ri-pencil-line"></i>
                                        </a>

                                        <a href="#" onClick="deleteUser({{ $user->id }})">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>

                                        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" id="delete-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
function deleteUser(id) {
    Swal.fire({
        title: 'Hapus user?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#delete-${id}`).submit();
        }
    })
}
</script>
@endpush
