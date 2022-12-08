<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\MapelModel;

;
use App\Models\PenilaianModel;
use App\Models\SiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class PenilaianController extends BaseController
{
    
    public function index()
    {
        return view('backend/penilaian/table',[
            'mapel' => (new MapelModel())->findAll()
            ]);  
            return view('backend/penilaian/table',[
                'siswa' => (new SiswaModel())->findAll()
                ]);                 
    }
    public function all(){
        
        $pm = PenilaianModel::view();
      
        
        return (new Datatable ($pm))
                ->setFieldFilter([ 'mapel', 'nis', 'nama_depan',
                 'total_nilai', 'deskripsi_nilai'])
                ->draw();
    }
    public function show($id){
        $r = (new PenilaianModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new PenilaianModel();

        $id =  $pm -> insert([
            'mapel_id'  => $this->request->getVar('mapel_id'),
            'siswa_id'     => $this->request->getVar('siswa_id'),
            'total_nilai'     => $this->request->getVar('total_nilai'),
            'deskripsi_nilai'=> $this->request->getVar('deskripsi_nilai'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $pm = new PenilaianModel();
        $id = (int)$this->request->getVar('id');
        
        if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $pm->update($id,[
            'mapel_id'  => $this->request->getVar('mapel_id'),
            'siswa_id'     => $this->request->getVar('siswa_id'),
            'total_nilai'     => $this->request->getVar('total_nilai'),
            'deskripsi_nilai'=> $this->request->getVar('deskripsi_nilai'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm = new PenilaianModel();
        $id = $this->request->getVar('id');
        $hasil = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
