#!/usr/bin/php
<?php
/**
 * demo.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  MIT Licence
 * @version  GIT: <fukuball/iloveck101>
 * @link     https://github.com/fukuball/iloveck101
 */
ini_set('memory_limit', '1024M');

require_once dirname(dirname(__FILE__))."/vendor/multi-array/MultiArray.php";
require_once dirname(dirname(__FILE__))."/vendor/multi-array/Factory/MultiArrayFactory.php";
use Tebru\MultiArray;

$content = fopen(dirname(dirname(__FILE__))."/dict/dict.small.txt", "r");

$trie = new MultiArray(array());

while (($line = fgets($content)) !== false) {

    echo $line;

    $explode_line = explode(" ", trim($line));
    $word = $explode_line[0];
    $l = mb_strlen($word, 'UTF-8');
    $word_c = array();
    for ($i=0; $i<$l; $i++) {
        $c = mb_substr($word, $i, 1, 'UTF-8');
        array_push($word_c, $c);
    }
    $word_c_key = implode('.', $word_c);
    $trie->set($word_c_key, array("end"=>""));

}

file_put_contents(dirname(dirname(__FILE__))."/dict/dict.small.txt.json", json_encode($trie->storage));
file_put_contents(dirname(dirname(__FILE__))."/dict/dict.small.txt.cache.json", json_encode($trie->cache));
?>