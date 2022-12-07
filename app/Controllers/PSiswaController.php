<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

use function PHPUnit\Framework\returnSelf;

class PSiswaController extends BaseController
{
    public function loginsiswa(){
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('sandi');

        $siswa = (new SiswaModel())->where('email', $email)->first();

        if($siswa == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $cekPaswword = password_verify($password, $siswa['sandi']);
        if($cekPaswword == false){
            return $this->response->setJSON(['message'=>'Email dan Password tidak cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('siswa', $siswa);
        return $this->response->setJSON(['message'=>"Selamat datang {$siswa['nama_depan']}"])
                    ->setStatusCode(200);
    }

    public function viewLoginsiswa(){
        return view('backend/siswa/login');
    }

    public function lupaPasswordsiswa(){
        $_email = $this->request->getPost('email');
        $password = $this->request->getPost('sandi');

        $siswa = (new SiswaModel())->where('email', $_email)->first();

        if($siswa == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $sandibaru =substr( md5( date('Y-m-dH:i:s')),5,5 );
        $siswa['sandi'] = password_hash($sandibaru,PASSWORD_BCRYPT);
        $r = (new SiswaModel())->update($siswa['id'], $siswa);

        if($r == false ){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('vbona2016@gmail.com', 'Sistem Informasi Sekolah');
        $email->setTo($siswa['email']);
        $email->setSubject('Reset sandi Pengguna');
        $email->setMessage("Halo {$siswa['nama_depan']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah dikirim ke alamat email $_email"])
                                  ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email $_email"])
                                 ->setStatusCode(500);
        }
    }

    public function viewLupaPasswordsiswa(){
        return view('lupa_password');
    }

    public function logoutsiswa(){
        $this->session->destroy();
        return redirect()->to('login');
    }
    
    public function index()
    {
        return view('backend/pegawai/siswa',[
            'kelas' => (new KelasModel())->findAll()
            ]);                
    }
    public function all(){
        $sm = SiswaModel::view();
        
        return (new Datatable ($sm))
                ->setFieldFilter([ 'nisn', 'nis', 'status_masuk' ,'thn_masuk', 'nama_depan'])
                ->draw();
    }
    public function show($id){
        $r = (new SiswaModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $sm = new SiswaModel();
        $sandi = $this->request->getVar('sandi');

        $id =  $sm -> insert([
            'nisn'          => $this->request->getVar('nisn'),
            'nis'           => $this->request->getVar('nis'),
            'status_masuk'  => $this->request->getVar('status_masuk'),
            'thn_masuk'     => $this->request->getVar('thn_masuk'),
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'nik'           => $this->request->getVar('nik'),
            'no_kk'         => $this->request->getVar('no_kk'),
            'gender'        => $this->request->getVar('gender'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'kelas_id'      => $this->request->getVar('kelas_id'),
            'no_telp_rumah' => $this->request->getVar('no_telp_rumah'),
            'no_hp_ibu'     => $this->request->getVar('no_hp_ibu'),
            'no_hp_ayah'    => $this->request->getVar('no_hp_ayah'),
            'nm_ayah'       => $this->request->getVar('nm_ayah'),
            'nm_ibu'        => $this->request->getVar('nm_ibu'),
            'nm_wali'       => $this->request->getVar('nm_wali'),
            'email'         => $this->request->getVar('email'),
            'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
        ]);
        if($id > 0){
            $this->savefile($id);
        }
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $sm = new SiswaModel();
        $id = (int)$this->request->getVar('id');
        $sandi = $this->request->getVar('sandi');
        
        if($sm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $sm->update($id,[
            'nisn'          => $this->request->getVar('nisn'),
            'nis'           => $this->request->getVar('nis'),
            'status_masuk'  => $this->request->getVar('status_masuk'),
            'thn_masuk'     => $this->request->getVar('thn_masuk'),
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'nik'           => $this->request->getVar('nik'),
            'no_kk'         => $this->request->getVar('no_kk'),
            'gender'        => $this->request->getVar('gender'),
            'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'kelas_id'      => $this->request->getVar('kelas_id'),
            'no_telp_rumah' => $this->request->getVar('no_telp_rumah'),
            'no_hp_ibu'     => $this->request->getVar('no_hp_ibu'),
            'no_hp_ayah'    => $this->request->getVar('no_hp_ayah'),
            'nm_ayah'       => $this->request->getVar('nm_ayah'),
            'nm_ibu'        => $this->request->getVar('nm_ibu'),
            'nm_wali'       => $this->request->getVar('nm_wali'),
            'email'         => $this->request->getVar('email'),
            'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
        ]);
        if($hasil == true){
            $this->savefile($id);
        }
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $sm = new SiswaModel();
        $id = $this->request->getVar('id');
        $hasil = $sm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    } 
    private function savefile($id){
        $file = $this->request->getFile('berkas');

        if ($file->hasMoved()== false){
            $path = WRITEPATH . 'uploads/siswa';

            if(file_exists($path) == false){
                @mkdir($path);
            }
       $file->store('siswa', $id . '.jpg');
        }
       
    }

    public function berkas($id){
        $pm = new SiswaModel();
        $dt = $pm->find($id);
        if($dt == null)throw PageNotFoundException::forPageNotFound();

        $file = WRITEPATH . 'uploads/siswa'.$id.'.jpg';
        if(file_exists($file) == false){
        throw PageNotFoundException::forPageNotFound();
    }
    
    echo file_get_contents($file);
    return $this->response->setHeader('Content-type','image/jpeg')
                ->sendBody();        
    }    
}

