<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */

 class PenilaianTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post' , 'penilaian' , [
            'mapel_id'         => '1',
            'siswa_id'         => '1',
            'total_nilai'      => '80',
            'deskripsi_nilai'  => 'Nilai Bahasa Indonesia',
        ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset( $js['id']) > 0);

        $this->call('get', "penilaian/". isset($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'penilaian' ,[
            'mapel_id'         => '1',
            'siswa_id'         => '1',
            'total_nilai'      => '80',
            'deskripsi_nilai'  => 'Nilai Bahasa Indonesia',
            
            'id' => isset($js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'penilaian', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'penilaian/all' )
             ->assertStatus(302);
    }
 }