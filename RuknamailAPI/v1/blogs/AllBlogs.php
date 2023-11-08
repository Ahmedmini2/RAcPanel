<?php 
require('../db/connect.php');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true ');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $fetch_news=$WebDB->prepare("SELECT  * FROM `oskarphone_web`.`oskar_news` WHERE `oskar_news`.`news_id`= :id");
    $fetch_news->execute([':id' => $id]);
    $res_news=$fetch_news->fetch(PDO::FETCH_OBJ);
    echo json_encode($res_news) ;
    return json_encode($res_news);
}else{
   
    
    $fetch_news=$WebDB->prepare("SELECT  * FROM `oskarphone_web`.`oskar_news` WHERE `oskar_news`.`status`=1   order by `oskar_news`.`updated` DESC");
    $fetch_news->execute();
    $res_news=$fetch_news->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($res_news) ;
    return json_encode($res_news);
}
?>