<?php
$host = 'db';
$db_name = 'magazin';
$db_user = 'root';
$db_pas = '1234';

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user, $db_pas);
}
catch (PDOException $e){
    print "error:" . $e->getMessage();
    die();
}
$stmt = $db->query("SELECT t.`ID`, t.`TITLE`, `DESCRIPTION`, `PRICE`, `COUNT`, t.TITLE AS KAT FROM products AS t JOIN categories AS k ON t.ID_CAT=k.ID");
echo '<table border="2">
<tr>
<td>id</td>
<td>title</td>
<td>description</td>
<td>price</td>
<td>count</td></tr>';   
while ($row = $stmt->fetch()){
    echo '<tr>';
    echo '<td>'.$row['ID'].'</td>';
    echo '<td>'.$row['TITLE'].'</td>';
    echo '<td>'.$row['DESCRIPTION'].'</td>';
    echo '<td>'.$row['PRICE'].'</td>';
    echo '<td>'.$row['COUNT'].'</td>';
    //echo '</td>'.$row['ID_CAT'].'</td>';
    echo '</tr>';
}
echo '</table>';
?>
