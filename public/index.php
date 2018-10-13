<?php
/**
 * Created by PhpStorm.
 * User: Shamix
 * Date: 10/13/18
 * Time: 6:39 AM
 */

echo '';

$data = csvReader::getData('sample.csv');
$htmlTable = tableMaker::makeTable($data);


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


echo $htmlTable.'<br>';

/*foreach ($data as $value){
      foreach ($value as $innerValue){
    echo $innerValue.'<br>';
    }
}*/

class tableMaker{

    public static function makeTable($data){

        $htmlTable = '<table class="table table-striped">';

        $headerData = array_shift($data);
        $htmlTable.= htmlMaker::makeHeader($headerData);


        $htmlTable.= '<tbody>';

        foreach($data as $value){
            $htmlTable.= htmlMaker::makeRow($value);
        }

        $htmlTable.= '</tbody>';
        $htmlTable.= '</table>';
        return($htmlTable);

    }

}

class htmlMaker{

    public static function makeHeader($headerData)
    {
        $htmlHeader = '<thead>
                        <tr>';
        foreach ($headerData as $value) {
            $htmlHeader .= '<th scope="col">' . $value . '</th>';
        }
        $htmlHeader .= '
            </tr>
        </thead>';
        return ($htmlHeader);
    }

    public static function makeRow($rowData){

        $htmlRow = '<tr>';

        foreach ($rowData as $value){
            $htmlRow.= '<td>'.$value.'</td>';
        }

        $htmlRow.= '</tr>';

        return($htmlRow);
    }

}