<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function pbkdf2( $p, $c, $kl, $a = 'sha256' )
{		
	// Do NOT edit this unless you are absolutely sure you know what you are doing.
	
	$CI = &get_instance();
	$s = $CI->config->item('password_salt');
	
    $hl = strlen(hash($a, null, true)); # Hash length
    $kb = ceil($kl / $hl);              # Key blocks to compute
    $dk = '';                           # Derived key
	
    # Create key
    for ( $block = 1; $block <= $kb; $block ++ )
	{
        # Initial hash for this block
        $ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
		
        # Perform block iterations
        for ( $i = 1; $i < $c; $i ++ )
			# XOR each iterate
            $ib ^= ($b = hash_hmac($a, $b, $p, true));
		
        $dk .= $ib; # Append iterated block
    }
 
    # Return derived key of correct length
    return substr($dk, 0, $kl);
    
} // End of function pbkdf2

function preparePassword($pass)
{
	return sha1($pass);
	
} // End of function preparePassword


function generateKey($pass)
{
	// Generates a key.
	// Do NOT edit this unless you are absolutely sure you know what you are doing.
	return pbkdf2($pass,100000,32);
	
} // End of function generateKey

function randomPassword($length = 8) {
	// Generates a random password.
	// TODO: Improve this!
	
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, strlen($alphabet)-1); //use strlen instead of count
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string

}

/* End of file encryption_helper.php */
/* Location: ./application/helpers/encryption_helper.php */
