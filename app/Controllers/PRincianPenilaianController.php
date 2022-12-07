<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PenilaianModel;

;
use App\Models\RincianpenilaianModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class PRincianPenilaianController extends BaseController
{
    
    public function index()
    {
        return view('backend/pegawai/rincianpenilaian',[
            'penilaian' => (new PenilaianModel())->findAll()
            ]);           
    }
    public function all(){
        
        $rpm = RincianpenilaianModel::view();
      
        
        return (new Datatable ($rpm))
                ->setFieldFilter([ 'total_nilai',  'nama_nilai',
                 'nilai_angka', 'nilai_deskripsi'])
                ->draw();
    }
    public function show($id){
        $r = (new RincianpenilaianModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $rpm = new RincianpenilaianModel();

        $id =  $rpm -> insert([
            'penilaian_id'  => $this->request->getVar('penilaian_id'),
            'nama_nilai'     => $this->request->getVar('nama_nilai'),
            'nilai_angka'     => $this->request->getVar('nilai_angka'),
            'nilai_deskripsi'=> $this->request->getVar('nilai_deskripsi'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $rpm = new RincianpenilaianModel();
        $id = (int)$this->request->getVar('id');
        
        if($rpm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $rpm->update($id,[
            'penilaian_id'  => $this->request->getVar('penilaian_id'),
            'nama_nilai'     => $this->request->getVar('nama_nilai'),
            'nilai_angka'     => $this->request->getVar('nilai_angka'),
            'nilai_deskripsi'=> $this->request->getVar('nilai_deskripsi'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $rpm = new RincianpenilaianModel();
        $id = $this->request->getVar('id');
        $hasil = $rpm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
