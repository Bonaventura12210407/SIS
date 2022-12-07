<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */

 class JadwalTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post' , 'jadwal' , [
            'hari'          => '2',
            'kelas_id'      => '1',
            'mapel_id'      => '1',
            'jam_mulai'     => '10:00',
            'jam_selesai'   => '12:00',
            'pegawai_id'    => '1',
        ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset( $js['id']) > 0);

        $this->call('get', "jadwal/". isset($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'jadwal' ,[
            'hari'          => '2',
            'kelas_id'      => '1',
            'mapel_id'      => '1',
            'jam_mulai'     => '10:00',
            'jam_selesai'   => '12:00',
            'pegawai_id'    => '1',
            
            'id' => isset($js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'jadwal', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'jadwal/all' )
             ->assertStatus(302);
    }
 }