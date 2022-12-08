<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */

 class KehadiranSiswaTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post' , 'kehadiransiswa' , [
            'kehadiran_guru_id' => '1',
            'siswa_id'          => '1',
            'status_hadir'      => 'Y',
            
        ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset( $js['id']) > 0);

        $this->call('get', "kehadiransiswa/". isset($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'kehadiransiswa' ,[
            'kehadiran_guru_id' => '1',
            'siswa_id'          => '1',
            'status_hadir'      => 'Y',
            
            'id' => isset($js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'kehadiransiswa', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'kehadiransiswa/all' )
             ->assertStatus(302);
    }
 }