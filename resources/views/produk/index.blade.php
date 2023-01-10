@extends('layout')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Kendaraan Mobil</div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <a class="btn btn-success" href="{{ route('produk.create') }}">Tambah Data Mobil</a>
                <p></p>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Stok Produk</th>
                            <th width="20%">Keterangan</th>
                            <th width="14%">Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Stok Produk</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>

                                <td>{{ ++$i }}</td>
                                <td>
                                    <center><img width="150px" align="center"
                                            src="{{ url('/data_file/' . $produk->gambar) }}"></center>
                                </td>
                                <td>{{ $produk->nm_produk }}</td>
                                <td>{{ $produk->harga }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ $produk->ket }}</td>
                                <td>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-warning" href="{{ route('produk.edit', $produk->id) }}">Ubah</a>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
