<?php
namespace App\Http\Controllers;
use App\Models\Sopir;
use Illuminate\Http\Request;

class SopirController extends Controller
{
    public function index()
    {
        $sopirs = Sopir::latest()->paginate(20);
        return view('sopir.index',compact('sopirs'))->with('i', (request()->input('page',1)-1) * 20);
    }
    
    public function create()
    {
        return view('sopir.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kd_sopir' => 'required',
            'nm_sopir' => 'required',
            'nohp' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'ket' => 'required',
        ]);
        Sopir::create($request->all());
        return redirect()->route('sopir.index')
                        ->with('success','Data berhasil disimpan.');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit(Sopir $sopir)
    {
        return view('sopir.edit',compact('sopir'));
    }
    
    public function update(Request $request, Sopir $sopir)
    {
        $request->validate([
            'kd_sopir' => 'required',
            'nm_sopir' => 'required',
            'nohp' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'ket' => 'required',
        ]);
      
        $sopir->update($request->all());
        return redirect()->route('sopir.index')
                        ->with('success','Data berhasil dirubah');
    }
    
    public function destroy(Sopir $sopir)
    {
        $sopir->delete();
        return redirect()->route('sopir.index')
                        ->with('success','Data berhasil dihapus');
    }
}


