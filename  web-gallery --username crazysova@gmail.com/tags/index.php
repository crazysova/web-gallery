<!--
Добавить функцию
1. Просмотр в экскизах в случ. порядке с завязкой на кнопку "другие" +
2. Возвращение из экскизов к нормальному просмотру (считать строчки и запис в фото)
3. переаисать структуру сайта
4. Авто смена изображений в случ порядке
-->


<html>
 <head>
  <meta charset="utf-8">
<link rel='STYLESHEET' type='text/css' href=file_inc/1.css>
  <title>Галерея</title>
 </head>
 <body style="background-color : #698b2a; background-image : url('file_inc/images/1.jpg'); background-repeat : no-repeat;">
<!--<DIV id="menu3" style="float : left; opacity : 0.7; width : 200px;">	
<ul><?php include ('file_inc/menu.html')?></ul>
</DIV>-->
<?php
#если просмотр пустой то просмотр foto
# p - просмотр
# foto - открывается file_inc/priv.html
if ($p != "") {$p = "$p";} else {$p = "foto";}
# s - случайно s или попорядку p
if ($s != "") {$s = "$s";} else {$s = "p";}
# берём случайную директорию
# хранятся имена всех разделов file_inc/dir.html
{
	$FILE = file("file_inc/dir.html");
	$rand = rand(0, count($FILE)-1);
	$rand_dir = $FILE[$rand];
}
# просмотр
if ($p == "video"){include "file_inc/video.html";}
elseif ($p == "foto"){include "file_inc/priv.html";}
# просмотр любой страницы
elseif ($p == "u"){include "$u";}
elseif ($p == "rar"){include "file_inc/rar.html";}
# full - экскизы, выводит все фото из папки в полном весе
elseif	($f == "full"){
	$hdl=opendir($p);
	while ($file = readdir($hdl))
	if ( ($file!=".")&&($file!="..")) $z[]=$file;
	closedir($hdl);
	rsort($z);
	foreach ($z as $value) {
	#echo "<!--<a href=\"index.php?s=r&p=$p\">--><a title=$z href=\"$p/$value\">";
	#echo ("<img style='float : left; height : 30%; max-height : 98%; max-width : 70%;' src=\"$p/$value\"></a>");
	echo ("<div class=\"sign\"><a title=$z href=\"$p/$value\"><img height=\"180px\" src=\"$p/$value\"></a></div>");}}
else {
# если идут по порядку начинать с 1 строчки
if ($s != "r") 
{
	if ($a != "") {$a = "$a";} else {$a = -1;}
	$a++;
	$FILE = file("$p.html");
	$rand = count($FILE)-1;
	$randtext = $FILE[$a]; 
}
else
# иначе показ в случайном порядке
{
	$FILE = file("$p.html");
	$rand = rand(0, count($FILE)-1);
	$randtext = $FILE[$rand];
}
# незнаю что хотела эта строчка
#if ($d == "r") {$dir = "$rand_dir";} else {$dir = "$p";}
# вывод фото в случайном пордке
echo "<a href=\"index.php?p=$p&a=$a&s=$s\"><img id=\"content\" style=\"float : left; height : 97%; max-height : 97%; max-width : 98%;\" src=\"$p/$randtext\"></a>";}?>
<!--кнопки управления-->
<div style="float : left; 
position: fixed; 
left: 0px; 
top: 0; ">
<a href="index.php"><img  id=no title="На главную" src="file_inc/images/go-home.png"></a><br>
<a href="index.php?s=r&p=<?php echo $p ?>&a=<?php echo $a ?>"><img  id=no title="В разброс" src="file_inc/images/view-refresh.png"></a><br>
<a href="index.php?s=p&p=<?php echo $p ?>&a=<?php echo $a ?>"><img  id=no title="Попорядку" src="file_inc/images/edit-redo.png"></a><br>
<a href="index.php?s=<?php echo $s ?>&p=<?php echo $rand_dir ?>&f=<?php echo $f ?>"><img  id=no title="Другую" src="file_inc/images/go-next.png"></a><br>
<a href="index.php?f=full&p=<?php echo $p ?>"><img  id=no title="Экскизы" src="file_inc/images/view-list-icons-symbolic.png"></a><br>
<a href="<?php echo $p?>/<?php echo $randtext ?>"><img  id=no title="Увеличить" src="file_inc/images/zoom-in.png"></a><br>
<a href="#niz"><img  id=no title="Вниз" src="file_inc/images/go-bottom.png"></a></div>
<!--<a href="index.php?d=<?php echo $d ?>&s=<?php echo $s ?>&p=full&p=<?php echo $dir ?>">
<img  id=no title="Другую" src="file_inc/go-next.png"></a><br>-->
<DIV style=float:left><a name="niz"></a></DIV>
 </body>

</html>
