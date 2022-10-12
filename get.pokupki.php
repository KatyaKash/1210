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

$result = '';
if (isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = sprintf('SELECT `ID` FROM `users` WHERE `TOKEN` LIKE \'%s\' AND `EXPIRED` > CURRENT_TIMESTAMP', $token);
    $stmt = $db->query($sql)->fetch();
    if (isset($stmt['ID'])) {
        $id_user = $stmt['ID'];
        $result = '{"pokupki":[';
        $sql = sprintf(' = %d', $id_user);
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch()){
            $result .= '{';
            $result .= '"id":'.$row['ID'].', "title":"'.$row['TITLE'].'","desc":"'.$row['DESCRIPTION'].'",'.$row['PRICE'].',"count":'.$row['COUNT'];
            $result .= '},';
        }
        $result = rtrim($result, ",");
        $result .= ']}';
    }
    else {
        $result = '{"error": {"text": "Неверный или просроченный токен"}}';
    }
}
else {
    $result = '{"error": {"text": "Не передан токен"}}';
}
echo $result;