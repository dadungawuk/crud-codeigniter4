<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_pegawai', 'jabatan_id', 'alamat', 'telepon', 'foto_pegawai'];

    // public function getPegawaiWithJabatan()
    // {
    //     return $this->select('pegawai.*, jabatan.nama_jabatan, jabatan.deskripsi_jabatan')
    //         ->join('jabatan', 'jabatan.id = pegawai.jabatan_id')->findAll();
    // }

    public function getPegawaiWithJabatan($perPage = 10, $page = 1)
    {
        return $this->select('pegawai.*, jabatan.nama_jabatan, jabatan.deskripsi_jabatan')
            ->join('jabatan', 'jabatan.id = pegawai.jabatan_id')->paginate($perPage, 'default', $page);
    }

    public function getPegawaiWithJabatanWhere($id)
    {
        return $this->select('pegawai.*, jabatan.nama_jabatan, jabatan.deskripsi_jabatan')
            ->join('jabatan', 'jabatan.id = pegawai.jabatan_id')->find($id);
    }
}
