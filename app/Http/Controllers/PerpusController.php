<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategoribuku;
use Illuminate\Http\Request;
use App\Models\koleksipribadi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerpusController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexp()
    {
        return view('peminjam.home');
    }















    public function buku()
    {
        $bukus = Buku::all();
        return view('admin.buku', ['bukus' => $bukus]);
    }

    public function bookinput(Request $request)
    {
        // Validate the request
        $request->validate([
            'Judul' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'Penerbit' => 'required|string|max:255',
            'TahunTerbit' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Define validation rules for the image
        ]);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            // Get the file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Concatenate the file name and extension
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload the image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            // If no image is uploaded, set a default value for $fileNameToStore
            $fileNameToStore = 'noimage.jpg';
        }
    
        // Create a new Buku instance with the form data
        $buku = new Buku;
        $buku->Judul = $request->input('Judul');
        $buku->Penulis = $request->input('Penulis');
        $buku->Penerbit = $request->input('Penerbit');
        $buku->TahunTerbit = $request->input('TahunTerbit');
        $buku->image = $fileNameToStore; // Set the image file name
        $buku->save();
    
        // Redirect back with success message
        return redirect()->route('admin.buku')->with('success', 'Data berhasil di Tambah');
    }

    public function bookedit(Request $request, $BukuID){
        $buku = Buku::find($BukuID);
    
        // Update other fields
        $buku->Judul = $request->input('Judul');
        $buku->Penulis = $request->input('Penulis');
        $buku->Penerbit = $request->input('Penerbit');
        $buku->TahunTerbit = $request->input('TahunTerbit');
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete existing image if needed
            Storage::delete('public/images/' . $buku->image);
    
            // Upload new image
            $imagePath = $request->file('image')->store('public/images');
            $buku->image = basename($imagePath);
        }
    
        // Save changes
        $buku->save();
    
        return redirect()->route('admin.buku')->with('ubah','Data berhasil di Ubah');
    }
    

    public function deleteBuku($id)
    {
        $id = Buku::find($id);
        $id->delete();
        return redirect()->route('admin.buku')->with('hapus','Data berhasil di Hapus');
    }




    public function katbuku()
    {
        $bukus = kategoribuku::all();
        return view('admin.kategori', ['kategoribukus' => $bukus]);
    }

    public function katbukuinput(Request $request)
    {
    kategoribuku::create($request->all());
    return redirect()->route('admin.kategori')->with('success','Data berhasil di Tambah');
    }

    public function katbukuedit(Request $request, $BukuID){
    $BukuID= kategoribuku::find($BukuID);
    $BukuID->update($request->all());
    return redirect()->route('admin.kategori')->with('ubah','Data berhasil di Ubah');
    }

    public function deletekatBuku($id)
    {
        $id = kategoribuku::find($id);
        $id->delete();
        return redirect()->route('admin.kategori')->with('hapus','Data berhasil di Hapus');
    }




    public function koleksi()
    {
        $koleksiPribadi = KoleksiPribadi::all();
        return view('admin.koleksi', ['koleksiPribadi' => $koleksiPribadi]);
    }

public function deleteKoleksi($id)
{
    $koleksi = KoleksiPribadi::find($id);
    
    if ($koleksi) {
        $koleksi->delete();
        return redirect()->route('admin.koleksi')->with('hapus', 'Data berhasil dihapus');
    } else {
        return redirect()->route('admin.koleksi')->with('error', 'Data tidak ditemukan');
    }
}




    public function perpustakaan()
    {
        $bukus = Buku::all();
        return view('peminjam.perpus', ['bukus' => $bukus]);
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
