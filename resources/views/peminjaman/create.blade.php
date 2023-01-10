@extends('layout')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Data Peminjaman</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Peminjaman</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-edit mr-1"></i>Data Peminjaman</div>
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

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Referensi:</label>
                                <input type="text" name="no_ref" class="form-control"
                                    placeholder="Masukkan Nomor Referensi" value="{{ time() }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Customer:</label>
                                <input type="text" name="no_cus" class="form-control"
                                    placeholder="Masukkan Nomor Customer" value="{{ rand(1000, 9999) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Nama Customer:</strong>
                                <input type="text" class="form-control" name="nm_cus"
                                    placeholder="Masukkan Nama Customer">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Produk:</strong>
                                <select class="form-control" name="produk" id="produk"
                                    onchange="changeValue(this.value)">
                                    <option>~Pilih Produk~</option>
                                    <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    ?>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}">{{ $produk->nm_produk }}</option>
                                        <?php
                                        $jsArray .=
                                            "prdName['" .
                                            $produk->id .
                                            "'] = {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            harga:'" .
                                            addslashes($produk->harga) .
                                            "',
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            stok:'" .
                                            addslashes($produk->stok) .
                                            "'};\n";
                                        ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Harga Sewa Kendaraan:</strong>
                                <input type="text" class="form-control" name="harga" id="harga" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Stok Kendaraan:</strong>
                                <input type="text" class="form-control" name="stok" id="stok" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Nama Sopir:</strong>
                                <select class="form-control" name="sopir" onchange="changeSopir(this.value)">
                                    <option>~Pilih Sopir~</option>
                                    @php
                                        $jsSopir = "var dataSopir = new Array();\n";
                                    @endphp
                                    @foreach ($sopirs as $sopir)
                                        <option value="{{ $sopir->id }}">{{ $sopir->nm_sopir }}</option>

                                        @php
                                            $jsSopir .=
                                                "dataSopir['" .
                                                $sopir->id .
                                                "'] = {
no_hp:'" .
                                                addslashes($sopir->nohp) .
                                                "',
alamat:'" .
                                                addslashes($sopir->alamat) .
                                                "'};\n";
                                        @endphp
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>No Hp:</strong>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Alamat:</strong>
                                <input type="text" class="form-control" name="alamat" id="alamat" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Jumlah:</strong>
                                <input type="text" class="form-control" name="jumlah"
                                    placeholder="Masukkan Jumlah Pinjam">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Lama Pinjam:</strong>
                                <input type="text" class="form-control" name="lama_pinjam"
                                    placeholder="Masukkan Lama Pinjam">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Tanggal Pinjam:</strong>
                                <input type="date" class="form-control" name="tgl_pinjam">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Tanggal Kembali:</strong>
                                <input type="date" class="form-control" name="tgl_kembali">
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a class="btn btn-primary" href="{{ route('sopir.index') }}"> Back</a>
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
                    @php
                        echo $jsArray;
                    @endphp

                    function changeValue(x) {
                        document.getElementById('harga').value = prdName[x].harga;
                        document.getElementById('stok').value = prdName[x].stok;
                    }
                </script>
                <script type="text/javascript">
                    @php
                        echo $jsSopir;
                    @endphp

                    function changeSopir(x) {
                        document.getElementById('no_hp').value = dataSopir[x].no_hp;
                        document.getElementById('alamat').value = dataSopir[x].alamat;
                    }
                </script>
            @endsection
