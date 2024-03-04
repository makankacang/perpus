<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku'; // Specify the table name if it's different from the plural of the class name

    protected $primaryKey = 'BukuID'; // Specify the primary key column
    public $timestamps = false;
    protected $guarded = ['created_at', 'updated_at'];

    protected $fillable = ['Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'image']; // Specify the columns that are mass assignable

    public function kategoris()
    {
        return $this->belongsToMany(Kategoribuku::class, 'kategoribuku_relasi', 'BukuID', 'KategoriID');
    }

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'BukuID', 'BukuID');
    }

    public function koleksi()
    {
        return $this->hasMany(koleksipribadi::class, 'BukuID');
    }
}
