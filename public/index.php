<?php
/**
 * Created by PhpStorm.
 * User: Shamix
 * Date: 10/13/18
 * Time: 6:39 AM
 */

echo 'Hello welcome to my project!';


class csvReader{
    private $filename;

    function getFilename(){
        return($this->filename);
    }

    function __construct($value){
        $this->filename = $value;
    }


    public static function dataArray(){
        $data = array();

        $file = fopen('sample.csv','r');

        $counter = 0;
        while (($line = fgetcsv($file)) !== FALSE) {
            //do nothing
            $data[] = $line;
            $counter++;
            echo $counter.'<br>';
        }
        fclose($file);

    }

}

$readerObject = new csvReader('sample.csv');
csvReader::dataArray();