@extends('layout')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Data Sopir</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Sopir</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-edit mr-1"></i>Update Data Sopir</div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sopir.update', $sopir->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Sopir:</label>
                                <input type="text" name="kd_sopir" class="form-control" value="{{ $sopir->kd_sopir }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Sopir:</label>
                                <input type="text" name="nm_sopir" class="form-control" value="{{ $sopir->nm_sopir }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>No. Handphone:</strong>
                                <input type="text" class="form-control" name="nohp"
                                    value="{{ $sopir->nohp }}"></input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Jenis Kelamin:</strong>
                                <select class="form-control" name="gender">
                                    <option value="{{ $sopir->gender }}">~{{ $sopir->gender }}~</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Alamat:</strong>
                                <textarea class="form-control" name="alamat">{{ $sopir->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Keterangan:</strong>
                                <textarea class="form-control" name="ket">{{ $sopir->ket }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a class="btn btn-primary" href="{{ route('sopir.index') }}"> Back</a>
                        </div>
                    </div>

                </form>
            @endsection
