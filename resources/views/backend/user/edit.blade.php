@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-12">
        <form class="row" method="post" action="{{ route('user.update', ['user' => $user->id]) }}">
            @csrf

            @method('PUT')
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Ubah User</h5>
                        </div>

                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Name Lengkap</label>
                                <div class="col-sm-9">
                                    <input class="form-control alpha-only" name="name" type="text" placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Alamat Email</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="email" type="email" placeholder="Alamat Email" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Nomor HP</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="phone" type="text" value="{{ $user->phone }}" placeholder="Nomor HP">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Role</label>
                                <div class="col-sm-9">
                                    <select class="w-100" name="role" required>
                                        <option disabled>Pilih Role</option>
                                        <option value="0" {{ $user->role === 0 ? 'selected' : '' }}>Admin</option>
                                        <option value="1" {{ $user->role === 1 ? 'selected' : '' }}>Kepala Depo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Password</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                </div>
                            </div>

                            @if (session()->get('errors'))
                            <p class="text-danger fw-bold">Gagal mengubah user:</p>
                            @php
                                $errors = session()->get('errors')->toArray();
                            @endphp
                            @foreach ($errors as $index => $error)
                                <p><span class="text-capitalize fw-bold">{{ $index }}</span>: {{ $error[0] }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <button type="submit" class="btn btn-primary">Ubah</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
