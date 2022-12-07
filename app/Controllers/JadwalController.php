<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\PegawaiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class JadwalController extends BaseController
{
    public function index()
    {
        return view('backend/jadwal/table',[
            'kelas' => (new KelasModel())->findAll()
            ]);    
            return view('backend/jadwal/table',[
                'mapel' => (new MapelModel())->findAll()
                ]);      
                return view('backend/jadwal/table',[
                    'pegawai' => (new PegawaiModel())->findAll()
                    ]);             
    }
    public function all(){
        return(new Datatable(JadwalModel::view()))
                ->setFieldFilter(['hari', 'jam_mulai' , 
                'jam_selesai' , 'nama_depan' , 'nama_belakang'])
                ->draw();
    }
    public function show($id){
        $r = (new JadwalModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $jm = new JadwalModel();

        $id =  $jm -> insert([
            'hari'          => $this->request->getVar('hari'),
            'kelas_id'      => $this->request->getVar('kelas_id'),
            'mapel_id'      => $this->request->getVar('mapel_id'),
            'jam_mulai'     => $this->request->getVar('jam_mulai'),
            'jam_selesai'   => $this->request->getVar('jam_selesai'),
            'pegawai_id'    => $this->request->getVar('pegawai_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $jm = new JadwalModel();
        $id = (int)$this->request->getVar('id');
        
        if($jm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $jm->update($id,[
            'hari'          => $this->request->getVar('hari'),
            'kelas_id'      => $this->request->getVar('kelas_id'),
            'mapel_id'      => $this->request->getVar('mapel_id'),
            'jam_mulai'     => $this->request->getVar('jam_mulai'),
            'jam_selesai'   => $this->request->getVar('jam_selesai'),
            'pegawai_id'    => $this->request->getVar('pegawai_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $jm = new JadwalModel();
        $id = $this->request->getVar('id');
        $hasil = $jm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
