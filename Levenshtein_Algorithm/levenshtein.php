<?php
/**
 * Created by PhpStorm.
 * User: MerveKAVUKLU
 * Date: 21.03.2018
 * Time: 11:29
 */
$_POST = json_decode(file_get_contents('php://input'), true);
$json_response = array();
if ( !empty($_POST['input']) ) {
// input misspelled word
    $input = stripslashes(strip_tags($_POST['input']));
    $dictionary = 'english.txt';
    $handle = fopen($dictionary, "r");

    while (!feof($handle)) {
        $words = fread($handle, 8192); 
    }
    fclose($handle);
    $words = explode("\r\n", $words);
    $shortest=-1;
    $tahmin=array();
    foreach ( $words as $word ) {
        $input_char = explodeEachChar($input);
        $input_array=array();
        foreach($input_char as $item)
        {
            array_push($input_array,$item);
        }
        $word_char = explodeEachChar($word);
        $word_array=array();
        foreach($word_char as $item)
        {
            array_push($word_array,$item);
        }
        $distance=levenshtein_func($input_array,$word_array,$input,$word);
        if($distance==0){
            $closest  = $word;
            $shortest = 0;
            $tahmin['oneri']=$closest;
            array_push($json_response,$tahmin);
            break;
        }
        else if($distance <= $shortest || $shortest < 0){
            $closest  = $word;
            $shortest = $distance;
            if($shortest<=1){
                $tahmin['oneri']=$closest;
                array_push($json_response,$tahmin);}
        }
    }
    echo json_encode($json_response);
}
function explodeEachChar($x) {
    $c = array();
    while (strlen($x) > 0) {
        $c[] = substr($x,0,1);
        $x = substr($x,1);
    }
    return $c;
}
function levenshtein_func($input_array,$word_array,$input,$word)
{
    $input_array_count = count($input_array);
    $word_array_count = count($word_array);
    $new_array = array();
    for ($i = 0; $i < $input_array_count + 1; $i++) {
        $new_array[$i][0] = $i;
    }
    for ($j = 0; $j < $word_array_count; $j++) {
        $new_array[0][$j] = $j;
    }
    for ($i = 1; $i < $input_array_count + 1; $i++) {
        for ($j = 1; $j < $word_array_count; $j++) {
            $new_array[$i][$j] = 0;
        }
    }
    for ($i = 1; $i < $input_array_count + 1; $i++) {
        for ($j = 1; $j < $word_array_count; $j++) {
            if ($input_array[$i - 1] == $word_array[$j - 1]) {
                $new_array[$i][$j] = $new_array[$i - 1][$j - 1];
            } else {
                $a = $new_array[$i][$j - 1] + 1;
                $b = $new_array[$i - 1][$j] + 1;
                $c = $new_array[$i - 1][$j - 1] + 1;
                if (($a < $b && $a < $c) || ($a==$b || $a==$c)) {
                    $new_array[$i][$j] = $a;
                }
                if ($b < $a && $b < $c || $a==$b || $b==$c) {
                    $new_array[$i][$j] = $b;
                }
                if ($c < $b && $c < $a || $c==$b || $a==$c) {
                    $new_array[$i][$j] = $c;
                }
            }

        }
    }
    return $new_array[$input_array_count][$word_array_count-1];
}
?>


