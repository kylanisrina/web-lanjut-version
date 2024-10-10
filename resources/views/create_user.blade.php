@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="logo">kylo</div>
        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Create User</h1>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="@error('nama') input-invalid @enderror">
            @error('nama')
                <div class="pesan-error">{{ $message }}</div>
            @enderror

            <label for="npm">NPM:</label>
            <input type="text" id="npm" name="npm" value="{{ old('npm') }}" class="@error('npm') input-invalid @enderror">
            @error('npm')
                <div class="pesan-error">{{ $message }}</div>
            @enderror

            <select name="kelas_id" id="kelas_id" class="@error('kelas_id') input-invalid @enderror">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                        {{ $kelasItem->nama_kelas }}
                    </option>
                @endforeach
            </select>
            @error('kelas_id')
                <div class="pesan-error">{{ $message }}</div>
            @enderror

            <input type="submit" value="Submit">
        </form>
    </div>
@endsection
