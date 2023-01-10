<?php
namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->paginate(20);
        return view('produk.index',compact('produks'))->with('i', (request()->input('page',1)-1) * 20);
        
    }
    
    public function create()
    {
        return view('produk.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nm_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'ket' => 'required',
            'gambar' => 'required',
        ]);

        //mengambil data file yang diupload
        // menyimpan data file yang diupload ke variabel $file
    $file = $request->file('gambar');
 
    $nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
    $tujuan_upload = 'data_file';
    $file->move($tujuan_upload,$nama_file);
      
        Produk::create([
            'nm_produk' => $request->nm_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'ket' => $request->ket,
            'gambar' => $nama_file,

            ]);
        return redirect()->route('produk.index')
                        ->with('success','Data berhasil disimpan.');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit(Produk $produk)
    {
        return view('produk.edit',compact('produk'));
    }
    
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nm_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'ket' => 'required',
        ]);
      
        $produk->update($request->all());
        return redirect()->route('produk.index')
                        ->with('success','Data berhasil dirubah');
    }
    
    public function destroy(Produk $produk)
    {
        File::delete('data_file/'.$produk->gambar);

        $produk->delete();
        return redirect()->route('produk.index')
        ->with('success','Data berhasil dihapus');
    }
}

