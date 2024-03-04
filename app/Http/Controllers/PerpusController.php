<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategoribuku;
use Illuminate\Http\Request;
use App\Models\peminjaman;
use App\Models\koleksipribadi;
use App\Models\kategoribuku_relasi;
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



    public function store(Request $request)
    {
        $request->validate([
            'tanggalPengembalian' => 'required|date|after:today',
            'bukuID' => 'required',
            'userID' => 'required',
        ]);
    
        Peminjaman::create([
            'BukuID' => $request->bukuID,
            'UserID' => $request->userID,
            'TanggalPeminjaman' => now(),
            'TanggalPengembalian' => $request->tanggalPengembalian,
            'StatusPeminjaman' => 'konfirmasi',
        ]);
    
        // Use JavaScript to show the toast message
        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }
    


    public function koleksip()
    {
        $koleksis = koleksipribadi::all();
        return view('peminjam.koleksi', ['koleksis' => $koleksis]);
    }



    public function addToCollection(Request $request)
    {
        // Validate the request if needed
        
        // Create the koleksipribadi entry
        Koleksipribadi::create([
            'UserID' => auth()->user()->id,
            'BukuID' => $request->bukuID,
        ]);
        
        // You can return a response if needed
        return response()->json(['message' => 'Added to collection successfully']);
    }




    public function buku()
    {
        $bukus = Buku::all();
        $categories = kategoribuku::all(); // Retrieve all categories
        return view('admin.buku', ['bukus' => $bukus, 'categories' => $categories]); // Pass categories to the view
    }
    

    public function bookinput(Request $request)
    {
        // Validate the request
        $request->validate([
            'Judul' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'Penerbit' => 'required|string|max:255',
            'TahunTerbit' => 'required|integer',
            'KategoriID' => 'required', // Ensure KategoriID is provided
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
    
        // Get the selected KategoriID
        $kategoriID = $request->input('KategoriID');
    
        // Create a new kategoribuku_relasi instance to establish the relationship
        $kategoribukuRelasi = new kategoribuku_relasi;
        $kategoribukuRelasi->BukuID = $buku->BukuID; // Assign the ID of the created Buku
        $kategoribukuRelasi->KategoriID = $kategoriID;
        $kategoribukuRelasi->save();
    
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
        // Find the book by its ID
        $buku = Buku::find($id);
    
        // Check if the book exists
        if($buku) {
            // Delete the image from storage
            Storage::delete('public/images/' . $buku->image);
            
            // Delete the book record from the database
            $buku->delete();
    
            // Redirect with a success message
            return redirect()->route('admin.buku')->with('hapus', 'Data berhasil dihapus');
        } else {
            // If the book doesn't exist, redirect with an error message
            return redirect()->route('admin.buku')->with('error', 'Buku tidak ditemukan');
        }
    }
    

    public function peminjaman()
    {
        // Load Peminjaman data with their associated Buku data using eager loading
        $peminjamans = Peminjaman::with('buku')->get();
        
        return view('admin.pinjaman', ['peminjamans' => $peminjamans]);
    }

    public function peminjamansaya()
    {
        $peminjamans = Peminjaman::all();
        return view('peminjam.pinjaman', ['peminjamans' => $peminjamans]);
    }
    
    public function konfirmasiPeminjaman($id)
    {
        // Find the peminjaman by ID
        $peminjaman = Peminjaman::findOrFail($id);
    
        // Update the status to 'dipinjam'
        $peminjaman->StatusPeminjaman = 'dipinjam';
        $peminjaman->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    public function kembalikanBuku($id)
    {
        // Find the peminjaman by ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Update the status to 'dikembalikan'
        $peminjaman->StatusPeminjaman = 'dikembalikan';
        $peminjaman->save();

        // Redirect back with a success message or any other action you want
        return redirect()->back()->with('success', 'Buku telah dikembalikan');
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
