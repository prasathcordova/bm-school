<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encryptor
 *
 * @author aju.docme
 */


declare(strict_types=1);
//require_once 'vendor/autoload.php';
require_once APPPATH.'libraries\Halite\HiddenString.php';



//use HiddenString;
use ParagonIE\Halite\Password;
use ParagonIE\Halite\KeyFactory;

class Encryptor {

    public function __construct() {
        
    }

    public function setData() {
$passwd = '';

        $passwd = new HiddenString('correct horse battery staple');
// Use random_bytes(16); to generate the salt:
        $salt = "\xdd\x7b\x1e\x38\x75\x9f\x72\x86\x0a\xe9\xc8\x58\xf6\x16\x0d\x3b";

        $encryptionKey = KeyFactory::deriveEncryptionKey($passwd, $salt);


//        $encryptionKey = KeyFactory::loadEncryptionKey('/path/outside/webroot/encryption.key');

        $message = new HiddenString('This is a confidential message for your eyes only.');
        $ciphertext = Symmetric::encrypt($message, $encryptionKey);

        $decrypted = Symmetric::decrypt($ciphertext, $encryptionKey);
        
        
        dev_export($ciphertext);
        
        dev_export($message);
        
        
        
        
        
    }

}
