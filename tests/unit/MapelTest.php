<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;



/**
 * @internal
 */

 class MapelTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
       $json = $this->call('post' , 'mapel' , [
            'mapel'             => 'Bahasa',
            'kelompok'          => 'A',
            'keterangan'        => 'testing',
            'tingkat'           => 'A',
            'kkm'               => '70',
            
       ])->getJSON();
        $js = json_decode($json, true);
        $this->assertNotTrue(isset ( $js['id']) > 0);

        $this->call('get', "mapel/". isset ($js['id']))
             ->assertStatus(302);

        $this->call('patch' , 'mapel' ,[
            'mapel'             => 'Bahasa',
            'kelompok'          => 'A',
            'keterangan'        => 'testing',
            'tingkat'           => 'A',
            'kkm'               => '70',
            
            'id' => isset( $js['id'])
            ])->assertStatus(302);
            
        $this->call('delete' , 'mapel', [
            'id' => isset($js['id'])
        ])->assertStatus(302);
    }

    public function testRead(){
        $this->call('get' , 'mapel/all' )
             ->assertStatus(302);
    }
 }