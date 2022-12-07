<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\BagianModel;
use App\Models\PegawaiModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;


class PegawaiController extends BaseController
{
    public function login(){
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('sandi');

        $pegawai = (new PegawaiModel())->where('email', $email)->first();

        if($pegawai == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $cekPaswword = password_verify($password, $pegawai['sandi']);
        if($cekPaswword == false){
            return $this->response->setJSON(['message'=>'Email dan Password tidak cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('pegawai', $pegawai);
        return $this->response->setJSON(['message'=>"Selamat datang {$pegawai['nama_depan']}"])
                    ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('backend/login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');
        $password = $this->request->getPost('sandi');

        $pegawai = (new PegawaiModel())->where('email', $_email)->first();

        if($pegawai == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $sandibaru =substr( md5( date('Y-m-dH:i:s')),5,5 );
        $pegawai['sandi'] = password_hash($sandibaru,PASSWORD_BCRYPT);
        $r = (new PegawaiModel())->update($pegawai['id'], $pegawai);

        if($r == false ){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('vbona2016@gmail.com', 'Sistem Informasi Sekolah');
        $email->setTo($pegawai['email']);
        $email->setSubject('Reset sandi Pengguna');
        $email->setMessage("Halo {$pegawai['nama_depan']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah dikirim ke alamat email $_email"])
                                  ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email $_email"])
                                 ->setStatusCode(500);
        }
    }

    public function viewLupaPassword(){
        return view('lupa_password');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }

    public function index()
    {
        return view('backend/pegawai/table',[
        'nama' => (new BagianModel())->findAll()
        ]);      
    }

    
    public function all(){
        $pegm = PegawaiModel::view();
         
        return (new Datatable($pegm))
        ->setFieldFilter([ 'nip' , 'nama_depan', 'nama_belakang',
         'gelar_depan' , 'gender',  'email',])
        ->draw();
    }
    public function show($id){
        $r = (new PegawaiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pegm = new PegawaiModel();
        $sandi = $this->request->getVar('sandi');

        $id =  $pegm -> insert([
            'nip'           => $this->request->getVar('nip'),
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gelar_depan'   => $this->request->getVar('gelar_depan'),
            'gelar_belakang'=> $this->request->getVar('gelar_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'no_wa'         => $this->request->getVar('no_wa'),
            'email'         => $this->request->getVar('email'),
            'bagian_id'     => $this->request->getVar('bagian_id'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
            'token_reset'   => $this->request->getVar('token_reset'),
        ]);
        if($id > 0){
            $this->savefile($id);
        }
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);
    }
    public function update(){
        $pegm = new PegawaiModel();
        $id = (int)$this->request->getVar('id');
        $sandi = $this->request->getVar('sandi');
        
        if($pegm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $pegm->update($id,[
            'nip'           => $this->request->getVar('nip'),
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gelar_depan'   => $this->request->getVar('gelar_depan'),
            'gelar_belakang'=> $this->request->getVar('gelar_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'no_wa'         => $this->request->getVar('no_wa'),
            'email'         => $this->request->getVar('email'),
            'bagian_id'     => $this->request->getVar('bagian_id'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
            'token_reset'   => $this->request->getVar('token_reset'),
        ]);
        if($hasil == true){
            $this->savefile($id);
        }
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pegm = new PegawaiModel();
        $id = $this->request->getVar('id');
        $hasil = $pegm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }

    private function savefile($id){
        $file = $this->request->getFile('berkas');

        if ($file->hasMoved()== false){
            $path = WRITEPATH . 'uploads/pegawai';

            if(file_exists($path) == false){
                @mkdir($path);
            }
       $file->store('pegawai', $id . '.jpg');
        }
       
    }

    public function berkas($id){
        $pm = new PegawaiModel();
        $dt = $pm->find($id);
        if($dt == null)throw PageNotFoundException::forPageNotFound();

        $file = WRITEPATH . 'uploads/pegawai'.$id.'.jpg';
        if(file_exists($file) == false){
        throw PageNotFoundException::forPageNotFound();
    }
    
    echo file_get_contents($file);
    return $this->response->setHeader('Content-type','image/jpeg')
                ->sendBody();        
    }    
}
