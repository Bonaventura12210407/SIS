<?php

namespace App\Controllers;

use Agoenxz21\Datatables;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\KehadiranGuru;
use App\Models\JadwalModel;
use App\Models\KehadiranguruModel;
use App\Models\PegawaiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class KehadiranGuruController extends BaseController
{
    public function index()
    {
        return view('backend/kehadiranguru/table',[
            'pegawai' => (new PegawaiModel())->findAll()
            ]);      
            return view('backend/kehadiranguru/table',[
                'jadwal' => (new JadwalModel())->findAll()
                ]);      
    }
    public function all(){
        $kgm = KehadiranguruModel::view();
         
        return (new Datatable($kgm))
        ->setFieldFilter([ 'waktu_masuk' , 'waktu_keluar' , 'pertemuan' , 'berita_acara', 'nama_depan',
            'nama_belakang'])
        ->draw();
    }
    public function show($id){
        $r = (new KehadiranguruModel()) -> where('id' ,  $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $kgm = new KehadiranguruModel();
        $id = $kgm -> insert ([
            'waktu_masuk'    => $this->request->getVar('waktu_masuk'),
            'waktu_keluar'   => $this->request->getVar('waktu_keluar'),
            'pertemuan'      => $this->request->getVar('pertemuan'),
            'pegawai_id'     => $this->request->getVar('pegawai_id'),
            'jadwal_id'      => $this->request->getVar('jadwal_id'),
            'berita_acara'   => $this->request->getVar('berita_acara'),

        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $kgm = new KehadiranguruModel();
        $id = (int)$this->request->getVar('id');
        if($kgm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $kgm->update($id,[
            'waktu_masuk'    => $this->request->getVar('waktu_masuk'),
            'waktu_keluar'   => $this->request->getVar('waktu_keluar'),
            'pertemuan'      => $this->request->getVar('pertemuan'),
            'pegawai_id'     => $this->request->getVar('pegawai_id'),
            'jadwal_id'      => $this->request->getVar('jadwal_id'),
            'berita_acara'   => $this->request->getVar('berita_acara'),
        ]);
    }
    public function delete(){
        $kgm    = new KehadiranguruModel();
        $id     = $this->request->getVar('id');
        $hasil  = $kgm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }
}


