<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\KelassiswaModel;
use App\Models\SiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class PKelasSiswaController extends BaseController
{
    public function index()
    {
        return view('backend/pegawai/kelassiswa',[
            'kelas' => (new KelasModel())->findAll()
            ]);  
            return view('backend/kelassiswa/table',[
                'siswa' => (new SiswaModel())->findAll()
                ]);             
    }
    public function all(){
        $kls = KelassiswaModel::view();
         
        return (new Datatable($kls))
        ->setFieldFilter([ 'tingkat', 'kelas' ,'nis', 'nama_depan' ,  'gender'])
        ->draw();
    }
    public function show($id){
        $r = (new KelassiswaModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $kls = new KelassiswaModel();

        $id =  $kls -> insert([
            'kelas_id'       => $this->request->getVar('kelas_id'),
            'siswa_id'    => $this->request->getVar('siswa_id'),
           
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $kls = new KelassiswaModel();
        $id = (int)$this->request->getVar('id');
        
        if($kls->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $kls->update($id,[
            'kelas_id'       => $this->request->getVar('kelas_id'),
            'siswa_id'    => $this->request->getVar('siswa_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $kls = new KelassiswaModel();
        $id = $this->request->getVar('id');
        $hasil = $kls->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
