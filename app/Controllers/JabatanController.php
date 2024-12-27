<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class JabatanController extends BaseController
{
    protected $modelJabatan;

    public function __construct()
    {
        // if (!session()->get('login')) {
        //     redirect()->to('/login')->with('error', 'harus login dulu ya..')->send();
        //     exit;
        // }
        $this->modelJabatan = new JabatanModel();
    }

    public function index()
    {

        $data['jabatan'] = $this->modelJabatan->findAll();
        return view('jabatan/index', $data);
    }

    public function show($id)
    {
        // 
    }

    public function create()
    {
        return view('jabatan/create');
    }

    public function store()
    {
        // tambah validasi
        $valData = $this->validate([
            'nama_jabatan' => 'required',
            'deskripsi_jabatan' => 'required',
        ]);

        if (!$valData) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // menangkap inputan dari form
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'deskripsi_jabatan' => $this->request->getPost('deskripsi_jabatan'),
        ];

        // proses simpan data
        $this->modelJabatan->save($data);
        // buat flashData
        session()->setFlashdata('sukses', 'Data jabatan berhasil ditambahkan.');
        return redirect()->to('jabatan');
    }

    public function edit($id)
    {
        $data['jabatan'] = $this->modelJabatan->find($id);
        return view('jabatan/edit', $data);
    }

    public function update($id)
    {
        // rule
        $rules = [
            'nama_jabatan' => 'required',
            'deskripsi_jabatan' => 'required',
        ];

        $errors = [
            'nama_jabatan' => [
                'required' => 'Nama Jabatan wajib diisi.'
            ],
            'deskripsi_jabatan' => [
                'required' => 'Deskripsi Jabatan wajib diisi.'
            ],
        ];

        // tambah validasi
        $valData = $this->validate($rules, $errors);

        if (!$valData) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'deskripsi_jabatan' => $this->request->getPost('deskripsi_jabatan'),
        ];

        $this->modelJabatan->save($data);
        return redirect()->to('jabatan')->with('sukses', 'Data jabatan berhasil diupdate.');
    }

    public function delete($id)
    {

        $modelPegawai = new PegawaiModel();
        $cekPegawai = $modelPegawai->where('jabatan_id', $id)->countAllResults();

        if ($cekPegawai > 0) {
            return redirect()->to('jabatan')->with('gagal', 'Data jabatan tidak dapat dihapus karena digunakan di data pegawai.');
        }

        // proses hapus
        $this->modelJabatan->delete($id);
        // buat flashData
        session()->setFlashdata('sukses', 'Data jabatan berhasil dihapus.');
        return redirect()->to('jabatan');
    }
}
