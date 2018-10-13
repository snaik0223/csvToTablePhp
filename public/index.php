<?php
/**
 * Created by PhpStorm.
 * User: Shamix
 * Date: 10/13/18
 * Time: 6:39 AM
 */

echo 'Hello welcome to my project!';


class csvReader{

   //This class is meant for representing CSV files

    public static function getData($filename){
        $data = array();
        $file = fopen($filename,'r');


        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line;
        }
        fclose($file);

        return($data);
    }

}



$data = csvReader::getData('sample.csv');


foreach ($data as $value){
      foreach ($value as $innerValue){
    echo $innerValue.'<br>';
    }
}


