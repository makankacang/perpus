<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ulasanbuku extends Model
{
    use HasFactory;

    protected $table = 'ulasanbuku'; // Specify the table name if it's different from the plural of the class name

    protected $primaryKey = 'UlasanID'; // Specify the primary key column
    public $timestamps = false;
    protected $guarded = ['created_at', 'updated_at'];

    protected $fillable = ['UlasanID', 'UserID', 'BukuID', 'Ulasan', 'Rating']; // Specify the columns that are mass assignable

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID', 'BukuID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
