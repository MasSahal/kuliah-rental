@extends('layout')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Peminjaman Kendaraan</div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <a class="btn btn-success" href="{{ route('peminjaman.create') }}">Tambah Data Peminjaman</a>
                <p></p>

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr align="center">
                            <th>No</th>
                            <th>No. Ref</th>
                            <th>Nama Customer</th>
                            <th>Kendaraan</th>
                            <th>Sopir</th>
                            <th>Lama Pinjam</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Total</th>
                            <th width="14%">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $peminjaman->no_ref }}</td>
                                <td>{{ $peminjaman->nm_cus }}</td>
                                <td>{{ $peminjaman->nm_produk }}</td>
                                <td>{{ $peminjaman->nm_sopir }}</td>
                                <td>{{ $peminjaman->lama_pinjam }} Hari</td>
                                <td>{{ $peminjaman->jumlah }} Produk</td>
                                <td>{{ $peminjaman->tgl_pinjam }}</td>
                                <td>{{ $peminjaman->tgl_kembali }}</td>
                                <td>Rp{{ number_format($peminjaman->total) }}</td>
                                <td>
                                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-warning"
                                            href="{{ route('peminjaman.edit', $peminjaman->id) }}">Ubah</a>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr align="center">
                            <th colspan="9">Total Transaksi</th>
                            <th>Rp{{ number_format($data->sum) }}</th>
                            <th width="14%"></th>
                        </tr>
                        <tr align="center">
                            <th colspan="9">Rata Rata Transaksi</th>
                            <th>Rp{{ number_format($data->avg) }}</th>
                            <th width="14%"></th>
                        </tr>
                        <tr align="center">
                            <th colspan="9">Transaksi Minimum</th>
                            <th>Rp{{ number_format($data->min) }}</th>
                            <th width="14%"></th>
                        </tr>
                        <tr align="center">
                            <th colspan="9">Transaksi Maksimal</th>
                            <th>Rp{{ number_format($data->max) }}</th>
                            <th width="14%"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
