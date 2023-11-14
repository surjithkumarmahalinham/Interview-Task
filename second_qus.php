<?php 

function checkvalue($arr)
{
    if(empty($arr))
    {
        return null;
    }

    $max = $arr[0];
    $min = $arr[0];

    foreach($arr as $data)
    {
        if($data > $max){
            $max = $data;
        } elseif ($data < $min){
            $min = $data;
        }
    }
    return array('max' => $max,'min' => $min);
}


$output = array(2,3,6,7,4,9,1);
$result = checkvalue($output);

