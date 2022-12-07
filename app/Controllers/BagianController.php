<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\BagianModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class BagianController extends BaseController
{
    
    public function index()
    {
        return view('backend/bagian/table');       
    }
    public function all(){
        $mm = new BagianModel();
        $mm->select(['id', 'nama', 'fungsi', 'tugas_pokok']);
        
        return (new Datatable ($mm))
                ->setFieldFilter(['nama', 'fungsi', 'tugas_pokok'])
                ->draw();
    }
    public function show($id){
        $r = (new BagianModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new BagianModel();

        $id =  $mm -> insert([
            'nama'       => $this->request->getVar('nama'),
            'fungsi'    => $this->request->getVar('fungsi'),
            'tugas_pokok'  => $this->request->getVar('tugas_pokok'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new BagianModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'nama'       => $this->request->getVar('nama'),
            'fungsi'    => $this->request->getVar('fungsi'),
            'tugas_pokok'  => $this->request->getVar('tugas_pokok'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new BagianModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
