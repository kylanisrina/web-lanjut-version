<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'npm',
        'kelas_id',
        'foto',
    ];


    public function getUser($id = null){
        // Jika $id null, kembalikan semua data user
    if ($id === null) {
        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                    ->select('user.*', 'kelas.nama_kelas')
                    ->get(); // Mendapatkan semua user dengan data kelas
    }

    // Jika $id tidak null, kembalikan user berdasarkan $id
    return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                ->select('user.*', 'kelas.nama_kelas')
                ->where('user.id', $id)
                ->first(); // Mendapatkan user berdasarkan ID dengan data kelas
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
