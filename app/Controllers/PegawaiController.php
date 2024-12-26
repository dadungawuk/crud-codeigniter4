<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiController extends BaseController
{
    protected $modelPegawai;

    public function __construct()
    {
        $this->modelPegawai = new PegawaiModel();
    }

    public function index()
    {
        // jumlah data per halaman
        $perPage = 10;
        // hal sekarang
        $page = $this->request->getVar('page') ?? 1;

        //ambil data pegawai
        // $data['pegawai'] = $this->modelPegawai->paginate($perPage, 'default', $page);
        $data['pegawai'] = $this->modelPegawai->getPegawaiWithJabatan($perPage, $page);

        $data['pager'] = $this->modelPegawai->pager;

        return view('pegawai/index', $data);
    }

    public function show($id)
    {
        $data['pegawai'] = $this->modelPegawai->getPegawaiWithJabatanWhere($id);
        return view('pegawai/show', $data);
    }

    public function create()
    {
        $modelJabatan = new JabatanModel();
        $data['jabatan'] = $modelJabatan->findAll();
        return view('pegawai/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_pegawai' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jabatan_id' => 'required|numeric',
            'file_foto' => 'uploaded[file_foto]|is_image[file_foto]|mime_in[file_foto,image/jpg,image/png,image/jpeg]|max_size[file_foto,1024]',
        ];

        $errors = [
            'nama_pegawai' => [
                'required' => 'Nama Pegawai wajib diisi.',
            ],
            'alamat' => [
                'required' => 'Alamat Pegawai wajib diisi.',
            ],
            'telepon' => [
                'required' => 'No. Telepon Pegawai wajib diisi.',
            ],
            'jabatan_id' => [
                'required' => 'Jabatan Pegawai wajib diisi.',
                'numeric' => 'Id Jabatan wajib angka/numeric.',
            ],
            'file_foto' => [
                'uploaded' => 'Foto pegawai wajib diunggah.',
                'is_image' => 'Foto pegawai harus gambar.',
                'mime_in' => 'Foto pegawai harus JPG, JPEG atau PNG.',
                'max_size' => 'Foto pegawai tidak boleh lebih dari 1MB.',
            ],
        ];

        $valData = $this->validate($rules, $errors);

        if (!$valData) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
        ];

        // menghandle foto
        $fileFoto = $this->request->getFile('file_foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('uploads', $namaFile);
            $data['foto_pegawai'] = $namaFile;
        }

        $this->modelPegawai->save($data);
        session()->setFlashdata([
            'swal_icon' => 'success',
            'swal_title' => 'Sukses!',
            'swal_text' => 'Data pegawai berhasil ditambahkan.'
        ]);
        return redirect()->to('pegawai');
    }

    public function edit($id)
    {
        $modelJabatan = new JabatanModel();
        $data['jabatan'] = $modelJabatan->findAll();
        $data['pegawai'] = $this->modelPegawai->find($id);
        return view('pegawai/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
        ];

        // menghandle foto
        $fileFoto = $this->request->getFile('file_foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('uploads', $namaFile);
            $data['foto_pegawai'] = $namaFile;

            // hapus foto lama jika ada
            $fotoLama = $this->request->getPost('foto_lama');
            if (!empty($fotoLama)) {
                $filePath = 'uploads/' . $fotoLama;
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $this->modelPegawai->save($data);
        session()->setFlashdata([
            'swal_icon' => 'success',
            'swal_title' => 'Sukses!',
            'swal_text' => 'Data pegawai berhasil diupdate.'
        ]);
        return redirect()->to('pegawai');
    }

    public function delete($id)
    {
        // $this->modelPegawai->delete($id);
        $pegawai = $this->modelPegawai->find($id);
        if ($pegawai) {
            if (!empty($pegawai->foto_pegawai)) {
                $filePath = 'uploads/' . $pegawai->foto_pegawai;
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
            $this->modelPegawai->delete($id);
        }
        session()->setFlashdata([
            'swal_icon' => 'success',
            'swal_title' => 'Sukses!',
            'swal_text' => 'Data pegawai berhasil dihapus.'
        ]);
        return redirect()->to('pegawai');
    }
}
