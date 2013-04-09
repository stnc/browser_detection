<?php include 'ua.class.php';
$detector =new detector($_SERVER ["HTTP_USER_AGENT"] );//new object creator	

echo $detector->get("browser");
echo '<br/>';

if ($detector->is("mobilebrowser")==true)
echo 'Mobile Browser';
echo '<br/>';
echo $detector->get("mobilebrowser");
echo '<br/>';
if ($detector->get("mobilebrowser")=="Apple iPhone")
echo 'Apple iPhone user<br>';

echo $detector->get("vipbots");   echo '<br/>';
if ($detector->is("vipbots")==true)
echo 'vip BOT';
echo '<br/>';

if ($detector->get("vipbots")=='Google Bot')
echo 'GOOGLE BOT YOur WEB SITE';
echo '<br/>';

echo $detector->get("robots");   echo '<br/>';

if ($detector->is("robots")==true)
echo 'your Robot Web site';
echo '<br/>';


echo $detector->get("operatingsystem");    echo '<br/>';

echo $detector->get("basicbrowser");  echo '<br/>';
?>