<?php
function Insert_data($tableName, $data) {
$columns=array_keys ($data);
$values=array_values ($data);
// $sql= "INSERT INTO $tableName (".implode(',', $columns).") 
//         VALUES ('".implode(',', $values)."')";

    $query = "INSERT INTO $tableName (".implode(',', $columns).") VALUES (".'"';
    $query .= implode('"'.','.'"',$values );

return $query.'")';
}
?>