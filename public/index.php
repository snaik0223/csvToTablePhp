<?php
/**
 * Created by PhpStorm.
 * User: Shamix
 * Date: 10/13/18
 * Time: 6:39 AM
 */

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
';

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