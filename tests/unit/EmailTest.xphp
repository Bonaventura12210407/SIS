<?php

use CodeIgniter\Email\Email;
use CodeIgniter\Test\CIUnitTestCase; 
use Config\Email as ConfigEmail;

/**
 * @internal
 */
class EmailTest extends CIUnitTestCase{
    
    public function testKirimEmail(){ 
        $email = new Email( new ConfigEmail());
        $email->setFrom('vbona2016@gmail.com');
        $email->setTo('vbona2017@gmail.com');
        $email->setSubject('Testing');
        $email->setMessage('Hallo');
    
        $this->assertTrue(  $email->send() );
    }
}