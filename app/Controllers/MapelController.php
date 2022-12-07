<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\MapelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class MapelController extends BaseController
{
    
    public function index()
    {
        return view('backend/mapel/table');       
    }
    public function all(){
        $mm = new MapelModel();
        $mm->select(['id', 'mapel', 'kelompok', 'keterangan', 'tingkat', 'kkm']);
        
        return (new Datatable ($mm))
                ->setFieldFilter(['mapel', 'kelompok' , 'keterangan', 'tingkat', 'kkm'])
                ->draw();
    }
    public function show($id){
        $r = (new MapelModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new MapelModel();

        $id =  $mm -> insert([
            'mapel'       => $this->request->getVar('mapel'),
            'kelompok'    => $this->request->getVar('kelompok'),
            'keterangan'  => $this->request->getVar('keterangan'),
            'tingkat'     => $this->request->getVar('tingkat'),
            'kkm'         => $this->request->getVar('kkm'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new MapelModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'mapel'       => $this->request->getVar('mapel'),
            'kelompok'    => $this->request->getVar('kelompok'),
            'keterangan'  => $this->request->getVar('keterangan'),
            'tingkat'     => $this->request->getVar('tingkat'),
            'kkm'         => $this->request->getVar('kkm'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new MapelModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
