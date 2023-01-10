<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Produk;
use App\Models\Sopir;
use Illuminate\Http\Request;
use DB;
use stdClass;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = DB::table('peminjaman')
            ->join('produk', 'produk.id', '=', 'peminjaman.produk')
            ->join('sopir', 'sopir.id', '=', 'peminjaman.sopir')
            ->get();

        $data = new stdClass;
        $data->sum = DB::table('peminjaman')->select(DB::raw("SUM(total) AS total_sum"))->first()->total_sum;
        $data->avg = DB::table('peminjaman')->select(DB::raw("AVG(total) AS total_avg"))->first()->total_avg;
        $data->min = DB::table('peminjaman')->select(DB::raw("MIN(total) AS total_min"))->first()->total_min;
        $data->max = DB::table('peminjaman')->select(DB::raw("MAX(total) AS total_max"))->first()->total_max;

        $summary = Peminjaman::all();
        // dd($data);
        return view('peminjaman.index', compact('peminjamans', 'data', 'summary'))->with('i');
    }

    public function create()
    {
        $produks = Produk::all();
        $sopirs = Sopir::all();
        return view('peminjaman.create', compact('produks', 'sopirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ref' => 'required',
            'no_cus' => 'required',
            'nm_cus' => 'required',
            'produk' => 'required',
            'sopir' => 'required',
            'jumlah' => 'required',
            'lama_pinjam' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ]);

        $harga_kendaraan = $request->input('harga');
        $jml = $request->input('jumlah');
        $lama = $request->input('lama_pinjam');
        $harga_sopir = 50000;
        $total = (($harga_kendaraan * $jml) * $lama) + $harga_sopir;
        $stok = $request->input('stok');
        $sisa = $stok - $jml;


        Peminjaman::create([
            'no_ref' => $request->no_ref,
            'no_cus' => $request->no_cus,
            'nm_cus' => $request->nm_cus,
            'produk' => $request->produk,
            'sopir'  => $request->sopir,
            'jumlah' => $request->jumlah,
            'lama_pinjam' => $request->lama_pinjam,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'total' => $total,
        ]);

        DB::table('produk')->where('id', $request->produk)->update([
            'stok' => $sisa
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Peminjaman $peminjaman)
    {
        $produks = Produk::all();
        $sopirs = Sopir::all();
        return view('peminjaman.edit', compact('peminjaman', 'produks', 'sopirs'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'no_ref' => 'required',
            'no_cus' => 'required',
            'nm_cus' => 'required',
            'produk' => 'required',
            'sopir' => 'required',
            'jumlah' => 'required',
            'lama_pinjam' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ]);

        $peminjaman->update($request->all());
        return redirect()->route('peminjaman.index')
            ->with('success', 'Data berhasil dirubah');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
