<?php
namespace App\Controllers;

use App\Models\ModelSiswa;
use CodeIgniter\Controller; 

class SiswaController extends BaseController {
    protected $model;

    function __construct() {
        $this->model = new ModelSiswa();
    }

    public function hapus($id) {
        $this->model->delete($id); 
        return redirect()->to('siswa');
    }

    public function edit($id) {
        return json_encode($this->model->find($id));
    }

    public function simpan() {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $wali = $this->request->getPost('wali');
        $kelamin = $this->request->getPost('kelamin');
        $alamat = $this->request->getPost('alamat');

        $data = [
            'nama' => $nama,
            'wali' => $wali,
            'jenis_kelamin' => $kelamin,
            'alamat' => $alamat
        ];

        if (!empty($id)) {
            $this->model->update($id, $data);
        } else {
            $this->model->insert($data);
        }

        return redirect()->to('siswa');
    }

    public function index() {
        $jumlahBaris = 5;
        $katakunci = $this->request->getGet('katakunci');
        if ($katakunci) {
            $pencarian = $this->model->like('nama', $katakunci)
                                     ->orLike('wali', $katakunci)
                                     ->orLike('jenis_kelamin', $katakunci)
                                     ->orLike('alamat', $katakunci);
        } else {
            $pencarian = $this->model;
        }
        $data['katakunci'] = $katakunci;
        $data['dataSiswa'] = $pencarian->orderBy('id', 'asc')->paginate($jumlahBaris);
        $data['pager'] = $this->model->pager;

        $halamanSekarang = $this->request->getVar('page') ?? 1;
        $data['nomor'] = ($halamanSekarang - 1) * $jumlahBaris;

        return view('siswa_view', $data);
    }
}
