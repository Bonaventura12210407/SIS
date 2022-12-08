<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KehadiranguruModel;
use App\Models\KehadiransiswaModel;
use App\Models\SiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class KehadiranSiswaController extends BaseController
{
    public function index()
    {
        return view('backend/kehadiransiswa/table',[
            'kehadiran_guru' => (new KehadiranguruModel())->findAll()
            ]);    
            return view('backend/kehadiransiswa/table',[
                'siswa' => (new SiswaModel())->findAll()
                ]);         
    }
    public function all(){
        $khs = KehadiransiswaModel::view();
         
        return (new Datatable($khs))
        ->setFieldFilter([ 'waktu_masuk' ,'waktu_keluar',  'nis', 'siswa' ,   'status_hadir'])
        ->draw();
    }
    public function show($id){
        $r = (new KehadiransiswaModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $khs = new KehadiransiswaModel();

        $id =  $khs -> insert([
            'kehadiran_guru_id'    => $this->request->getVar('kehadiran_guru_id'),
            'siswa_id'             => $this->request->getVar('siswa_id'),
            'status_hadir'         => $this->request->getVar('status_hadir'),
           
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $khs = new KehadiransiswaModel();
        $id = (int)$this->request->getVar('id');
        
        if($khs->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $khs->update($id,[
            'kehadiran_guru_id'    => $this->request->getVar('kehadiran_guru_id'),
            'siswa_id'             => $this->request->getVar('siswa_id'),
            'status_hadir'         => $this->request->getVar('status_hadir'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $khs = new KehadiransiswaModel();
        $id = $this->request->getVar('id');
        $hasil = $khs->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
