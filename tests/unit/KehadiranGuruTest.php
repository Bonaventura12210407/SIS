<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */

 class KehadiranGuruTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post' , 'kehadiranguru' , [
            'waktu_masuk'   => '10:00:00',
            'waktu_keluar'  => '12:00:00',
            'pertemuan'     => '1',
            'pegawai_id'    => '1',
            'jadwal_id'     => '1',
            'berita_acara'  => 'Mengajar Bahasa Indonesia',
        ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset( $js['id']) > 0);

        $this->call('get', "kehadiranguru/". isset($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'kehadiranguru' ,[
            'waktu_masuk'   => '10:00:00',
            'waktu_keluar'  => '12:00:00',
            'pertemuan'     => '1',
            'pegawai_id'    => '1',
            'jadwal_id'     => '1',
            'berita_acara'  => 'Mengajar Bahasa Indonesia',
            
            'id' => isset($js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'kehadiranguru', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'kehadiranguru/all' )
             ->assertStatus(302);
    }
 }