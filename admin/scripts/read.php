<?php 

    function getAll($tbl){

        include('connect.php');

        $queryAll = 'SELECT * FROM '.$tbl;
        $runAll = $pdo->query($queryAll);

        if($runAll){

            return $runAll;
        }else {

            $error = 'There was a problem accessing this info';
            return $error;
        }
    }

    function getSingle($tbl, $col, $value){

        include('connect.php');
        $querySingle = 'SELECT * FROM '.$tbl.' WHERE '.$col.' = '.$value;
        $runSingle = $pdo->query($querySingle);
        if ($runSingle){
            return $runSingle;
        } else {

            $error = 'There was a problem';
            return $error;
        }
    }

    function filterResults($tbl, $tbl2, $tbl3, $col, $col2, $col3, $filter) {
        include('connect.php');
        //TODO: write the SQL query to fetching everything 
        // from the linking tables $tbl, $tbl_2, $tbl_3
        $filterQuery = 'SELECT * FROM ' .$tbl.' as a, ';
        $filterQuery.= $tbl2.' as b, ';
        $filterQuery.= $tbl3.' as c ';
        $filterQuery.= 'WHERE a.' .$col.' = c.'.$col;
        $filterQuery.= ' AND b.' .$col2.' = c.'.$col2;
        $filterQuery.= ' AND b.' .$col3.' = "'.$filter.'"';
        //echo $filterQuery; 
        //exit;
        $runQuery = $pdo->query($filterQuery);
        if($runQuery){

                return $runQuery;
        }

        else{
            $error = 'There was a problem';
            return $error;
        }
    }

?>