<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */

 class RincianPenilaianTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post' , 'rincianpenilaian' , [
            'penilaian_id'          => '1',
            'nama_nilai'            => 'delapan_puluh',
            'nilai_angka'           => '80',
            'nilai_deskripsi'       => 'teruskan',
        ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset( $js['id']) > 0);

        $this->call('get', "rincianpenilaian/". isset($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'rincianpenilaian' ,[
            'penilaian_id'          => '1',
            'nama_nilai'            => 'delapan_puluh',
            'nilai_angka'           => '80',
            'nilai_deskripsi'       => 'teruskan',
            
            'id' => isset($js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'rincianpenilaian', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'rincianpenilaian/all' )
             ->assertStatus(302);
    }
 }