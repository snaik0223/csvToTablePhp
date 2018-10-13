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

main::start('sample.csv');

/*
 * The main class is the control of the code.
 * It calls the remaining classes for the following functions:
 * csvReader class : contains the getData function to extract the data from the csv file
 * tableMaker class : contains the makeTable function which constructs the html required to render a table
 * htmlMaker class : this class contains functions makeHeader and makeRow to make these components of an html table
 */

class main{
    public static function start($filename){
        $data = csvReader::getData($filename);
        $htmlTable = tableMaker::makeTable($data);
        echo $htmlTable;
    }

}


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


class tableMaker{

    public static function makeTable($data){

        $htmlTable = '<table class="table table-striped">';

        $headerData = array_shift($data);
        $htmlTable.= htmlMaker::makeHeader($headerData);


        $htmlTable.= '<tbody>';

        foreach($data as $value){
            $htmlTable.= htmlMaker::makeRows($value);
        }

        $htmlTable.= '</tbody>';
        $htmlTable.= '</table>';
        return($htmlTable);

    }

}


class htmlMaker{

    // create html for a table header
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

    // create html for rows in a table
    public static function makeRows($rowData){

        $htmlRow = '<tr>';

        foreach ($rowData as $value){
            $htmlRow.= '<td style="padding: 20px;">'.$value.'</td>';
        }

        $htmlRow.= '</tr>';

        return($htmlRow);
    }

}