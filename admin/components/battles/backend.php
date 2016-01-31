<?php
if(!defined('VALID_CMS_ADMIN')) { die('ACCESS DENIED'); }
$u= explode('.', $_SERVER["SERVER_NAME"]);
$opt = $inCore->request('opt', 'str', 'config');
$item_id = $inCore->request('item_id', 'str', 'config');
$cfg = $inCore->loadComponentConfig('battles');
if (isset($_REQUEST['opt'])) { $opt = $_REQUEST['opt']; } else { $opt = 'list'; }
// ======================общее меню
cpAddPathway('Битва титанов', '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=list');
echo '<h3>Битва титанов</h3>';
$toolmenu[0]['icon'] = 'liststuff.gif';
$toolmenu[0]['title'] = 'Все битвы';
$toolmenu[0]['link'] = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=list';
$toolmenu[1]['icon'] = 'newforum.gif';
$toolmenu[1]['title'] = 'Создать битву';
$toolmenu[1]['link'] = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=newbattle';		
$toolmenu[2]['icon'] = 'config.gif';
$toolmenu[2]['title'] = 'Настройки';
$toolmenu[2]['link'] = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=config';
$toolmenu[3]['icon'] = 'help.gif';
$toolmenu[3]['title'] = 'Помощь';
$toolmenu[3]['link'] = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=help';
// ======================общее меню
if($opt=='saveconfig'){	      
	$cfg['key']	=	$inCore->request('key', 'str', 0);
	$inCore->saveComponentConfig('battles', $cfg);
	$msg = 'Настройки сохранены.';
	$opt = 'config';
}	
if (@$msg) { echo '<p class="success">'.$msg.'</p>'; } // сообщение о сохранении 

// -- конфигурация

if ($opt=='config' || $opt=='saveconfig') { 
		$toolmenu[20]['icon'] = 'save.gif';
		$toolmenu[20]['title'] = 'Сохранить';
		$toolmenu[20]['link'] = 'javascript:document.addform.submit();';

		$toolmenu[21]['icon'] = 'cancel.gif';
		$toolmenu[21]['title'] = 'Отмена';
		$toolmenu[21]['link'] = 'javascript:history.go(-1);';
cpToolMenu($toolmenu);
?><br>
<form id="addform" name="addform" action="index.php?view=components&amp;do=config&amp;id=<?php echo $_REQUEST['id'];?>"  method="post">
<table width="680" border="0" cellpadding="10" cellspacing="0" class="proptable">
	<tr>
		<td valign="top"><strong>Ключ компонента: </strong></td>
		<td valign="top"><input name="key" size="60" type="text" value="<?=$cfg['key'];?>"></td>
	</tr> 	
</table>
<input name="opt" type="hidden" id="do" value="saveconfig" />
	<input class="button" name="save" type="submit" id="save" value="Сохранить" />
	<input class="button" name="back" type="button" id="back" value="Отмена" onclick="window.location.href='index.php?view=components';"/>
</form>
<?php installCheckFolders(); ?>
<?
cpAddPathway('Настройки', '');
}


function installCheckFolders(){
	$folders = array();
	$folders[] = '/images/battles';
	echo '<br><br><table align="center" class="proptable" width="680">';
		echo '<tr>';
			echo '<th style="text-align:center" width="260"><b>Папка</b></th>';
			echo '<th style="text-align:center" width="170"><b>Доступна для записи</b></th>';
		echo '</tr>';

	foreach($folders as $key=>$folder){	
		$right = true;
		if(!@is_writable($_SERVER['DOCUMENT_ROOT'].$folder)){
			if (!@chmod($_SERVER['DOCUMENT_ROOT'].$folder, 0777)){
				$right = false;;
			}
		}
		echo '<tr>';
			echo '<td style="text-align:center" class="folder"><strong>'.$folder.'</strong></td>';
			echo '<td style="text-align:center">'.($right ? '<span style="color:green">Да</span>' : '<span style="color:red">Нет</span>').'</td>';
		echo '</tr>';
	}
	
	echo '</table>';
}
// если битвы скрывать
	if ($opt == 'show'){
		if(isset($_REQUEST['item_id'])) { 
			$id = (int)$_REQUEST['item_id'];
			$sql = "UPDATE cms_battles SET published = 1 WHERE id = $id";
			dbQuery($sql) ;
			echo '1'; exit;
		}
	}

	if ($opt == 'hide'){
		if(isset($_REQUEST['item_id'])) { 
			$id = (int)$_REQUEST['item_id'];
			$sql = "UPDATE cms_battles SET published = 0 WHERE id = $id";
			dbQuery($sql) ;
			echo '1'; exit;
		}
	}

// ---------------------------------------------------------------------
// Все битвы
if($opt=='list'){		cpAddPathway('Все битвы', ''); cpToolMenu($toolmenu);
$fields = array();
 $fields[1]['title'] = 'id';			
 $fields[1]['field'] = 'id';			
 $fields[1]['width'] = '30';
 $fields[2]['title'] = 'Название';	
 $fields[2]['field'] = 'title';		
 $fields[2]['width'] = '';
 $fields[2]['link']  = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=edit&item_id=%id%';
 $fields[4]['title'] = 'Закончится';	
 $fields[4]['field'] = 'timestop';		
 $fields[4]['width'] = '120';  
 
 $fields[3]['title'] = 'Статус';		
 $fields[3]['field'] = 'published';	
 $fields[3]['width'] = '100';
 $fields[3]['do'] = 'opt'; 
 $fields[3]['do_suffix'] = '';
	
$actions = array();
 $actions[0]['title'] = 'Редактировать';
 $actions[0]['icon']  = 'edit.gif';
 $actions[0]['link']  = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=edit&item_id=%id%';
 
 $actions[1]['title'] = 'Удалить';
 $actions[1]['icon']  = 'delete.gif';
 $actions[1]['confirm'] = 'Вы действительно хотите удалить битву?';
 $actions[1]['link']  = '?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=del&item_id=%id%';
cpListTable('cms_battles', $fields, $actions, '', '');
cpAddPathway('Список категорий', '');
}
// Все битвы
// Создать битву
if($opt=='newbattle'){			cpAddPathway('Создать битву', ''); cpToolMenu($toolmenu);
?><br>
<script type="text/javascript" src="/components/battles/js/jquery2.js"></script>
<script type="text/javascript" src="/components/battles/js/ajaxupload.js"></script>
<script type="text/javascript" src="/components/battles/js/script.js"></script>
<br>

<form id="addform" name="addform" action="?view=components&do=config&id=<?=(int)$_REQUEST['id'];?>&opt=add" method="post" onsubmit="return SendForm();">
<table width="680" border="0" cellspacing="5" class="proptable">
	<tr>
		<td align="center" colspan="3"><font><strong>Выберите файл размером 150 на 150 нажав на картинку загрузки.</strong></font><br>Не загружайте файлы названые на кирилице, и размером больше 150 на 150. Загрузчик не обрезает картинки. Файлы приготовьте заранее. Если Вам нужна битва на 2 варианта, то заполните только две формы.</td>
	</tr>
	<tr>
		<td width="50%" valign="top" align="center">
			<div id="uploadButton1">
			<img id="load" src="/components/battles/img/loadstop.gif"/>
			</div>
			<div id="files1">Загруженный файл :</div>
			
		</td>
		<td width="50%" valign="top" align="center">
			<div id="uploadButton2">
			<img id="load" src="/components/battles/img/loadstop.gif"/>
			</div>
			<div id="files2">Загруженный файл :</div>
			
		</td>
		<td width="50%" valign="top" align="center">
			<div id="uploadButton3">
			<img id="load" src="/components/battles/img/loadstop.gif"/>
			</div>
			<div id="files3">Загруженный файл :</div>
			
		</td>
	</tr>
	<tr>
		<td width="50%" valign="top" align="center">Заголовок 1.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol1" value="" size="30"><br><br>
		Поддержка первого претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text1" cols="40" rows="5"></textarea>
		</td>
		<td width="50%" valign="top" align="center">Заголовок 2.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol2" value="" size="30"><br><br>
		Поддержка второго претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text2" cols="40" rows="5"></textarea>
		</td>
		<td width="50%" valign="top" align="center">Заголовок 3.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol3" value="" size="30"><br><br>
		Поддержка третьего претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text3" cols="40" rows="5"></textarea>
		</td>
		
	</tr>
	<tr>
		<td align="center" colspan="3">Название битвы<br>
		<input type="text" name="title" value="" size="50"></td>
	</tr>
	<tr>
		<td align="center" colspan="3">Время окончания<br>
		<input type="text" name="timestop" value="<?=date('Y-m-d H:i:s');?>" size="22"></td>
	</tr>
	<tr>
		<td align="center" colspan="3"><input class="button" type="submit" value="Создать битву"></td>
	</tr>
</table>
</form>
<?
}
if($opt=='add'){
// добавить и редирект

 $files1 = mysql_escape_string($_POST["files1"]);
 $files2 = mysql_escape_string($_POST["files2"]);
 $files3 = mysql_escape_string($_POST["files3"]);
 
 $text1 = mysql_escape_string($_POST["text1"]);
 $text2 = mysql_escape_string($_POST["text2"]);
 $text3 = mysql_escape_string($_POST["text3"]);
 
 $zagol1 = mysql_escape_string($_POST["zagol1"]); 
 $zagol2 = mysql_escape_string($_POST["zagol2"]);
 $zagol3 = mysql_escape_string($_POST["zagol3"]);
  
 $title = mysql_escape_string($_POST["title"]); 
 $timestop = mysql_escape_string($_POST["timestop"]);
$sql="INSERT INTO `cms_battles` 
(`title`,`files1`,`files2`,`files3`,`text1`,`text2`,`text3`,`zagol1`,`zagol2`,`zagol3`,`timestop`)
VALUES 
('".$title."','".$files1."','".$files2."','".$files3."','".$text1."','".$text2."','".$text3."','".$zagol1."','".$zagol2."','".$zagol3."','".$timestop."')";
dbQuery($sql);
$inCore->redirect('?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=list'); // уходим отсюда	
}
// Создать битву
// Удалить битву
if($opt=='del'){
$sql = "
	    SELECT * 
	    FROM `cms_battles`
	    WHERE `id`=".(int)$_REQUEST['item_id']."";
        $result = dbQuery($sql) ;
while ($row = mysql_fetch_array($result)) {
unlink (''.$_SERVER["DOCUMENT_ROOT"].'/images/battles/'.$row['files1'].'');
unlink (''.$_SERVER["DOCUMENT_ROOT"].'/images/battles/'.$row['files2'].'');
unlink (''.$_SERVER["DOCUMENT_ROOT"].'/images/battles/'.$row['files3'].'');
}


$item_id = mysql_escape_string($item_id);
$sql="DELETE FROM `cms_battles` WHERE `id` = ".$item_id."";
dbQuery($sql);
$inCore->redirect('?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=list'); // уходим отсюда
}
// Удалить битву
// Помощь
if($opt=='help'){			cpAddPathway('Помощь', ''); cpToolMenu($toolmenu);
?>
<!--<iframe width="100%" height="500" src="http://instant.clubcontact.ru/forum/" frameborder="0" scrolling="auto"></iframe> -->
В разработке.
<?
}
//Помощь
if($opt=='edit'){			cpAddPathway('Редактируем', ''); cpToolMenu($toolmenu);
$sql = "
	    SELECT * 
	    FROM `cms_battles`
	    WHERE `id`=".(int)$_REQUEST['item_id']."";
        $result = dbQuery($sql) ;
while ($row = mysql_fetch_array($result)) {
$bid=$row['id'];
$files1= '/images/battles/'.$row['files1'].'';
$files2= '/images/battles/'.$row['files2'].'';
$files3= '/images/battles/'.$row['files3'].'';
$text1= $row['text1'];
$text2= $row['text2'];
$text3= $row['text3'];
$zagol1= $row['zagol1'];
$zagol2= $row['zagol2'];
$zagol3= $row['zagol3'];
$title= $row['title'];
$timestop= $row['timestop'];
if ($text3) {
$col='3';
} else {$col='2';}
}
?>
<form id="addform" name="addform" action="?view=components&do=config&id=<?=(int)$_REQUEST['id'];?>&opt=edited" method="post" onsubmit="return SendForm();">
<input type="hidden" name="bid" value="<?=$bid;?>">
<table width="680" border="0" cellspacing="5" class="proptable">
	<tr>
		<td align="center" colspan="3"><font><strong>Выберите файл размером 150 на 150 нажав на картинку загрузки.</strong></font><br>Не загружайте файлы названые на кирилице, и размером больше 150 на 150. Загрузчик не обрезает картинки. Файлы приготовьте заранее. Если Вам нужна битва на 2 варианта, то заполните только две формы.</td>
	</tr>
	<tr>
		<td width="50%" valign="top" align="center"><img id="load" src="<?=$files1;?>"/></td>
		<td width="50%" valign="top" align="center"><img id="load" src="<?=$files2;?>"/></td>
		<?php 
		if ($text3) {
		?>
		<td width="50%" valign="top" align="center"><img id="load" src="<?=$files3;?>"/></td>
		<? } ?>
	</tr>
	<tr>
		<td width="50%" valign="top" align="center">Заголовок 1.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol1" value="<?=$zagol1;?>" size="30"><br><br>
		Поддержка первого претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text1" cols="40" rows="5"><?=$text1;?></textarea>
		</td>
		<td width="50%" valign="top" align="center">Заголовок 2.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol2" value="<?=$zagol2;?>" size="30"><br><br>
		Поддержка второго претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text2" cols="40" rows="5"><?=$text2;?></textarea>
		</td>
		<?php 
		if ($text3) {
		?>
		<td width="50%" valign="top" align="center">Заголовок 3.<br>Публикуется в социальных сетях в качестве главного заголовка.<br>
		<input type="text" name="zagol3" value="<?=$zagol3;?>" size="30"><br><br>
		Поддержка третьего претендента.<br>Надпись будет видна в социальных сетях.<br><textarea name="text3" cols="40" rows="5"><?=$text3;?></textarea>
		</td>
		<?php } ?>
	</tr>
	<tr>
		<td align="center" colspan="<?=$col;?>">Название битвы<br>
		<input type="text" name="title" value="<?=$title;?>" size="50"></td>
	</tr>
	<tr>
		<td align="center" colspan="<?=$col;?>">Время окончания<br>
		<input type="text" name="timestop" value="<?=$timestop;?>" size="22"></td>
	</tr>
	<tr>
		<td align="center" colspan="<?=$col;?>"><input class="button" type="submit" value="Сохрнить битву"></td>
	</tr>
</table>
</form>
<?
}
if($opt=='edited'){
 $bid = mysql_escape_string($_POST["bid"]); 
 $files1 = mysql_escape_string($_POST["files1"]);
 $files2 = mysql_escape_string($_POST["files2"]);
 $files3 = mysql_escape_string($_POST["files3"]);
 
 $text1 = mysql_escape_string($_POST["text1"]);
 $text2 = mysql_escape_string($_POST["text2"]);
 $text3 = mysql_escape_string($_POST["text3"]);
 
 $zagol1 = mysql_escape_string($_POST["zagol1"]); 
 $zagol2 = mysql_escape_string($_POST["zagol2"]);
 $zagol3 = mysql_escape_string($_POST["zagol3"]);
  
 $title = mysql_escape_string($_POST["title"]); 
 $timestop = mysql_escape_string($_POST["timestop"]);
$sql="UPDATE `cms_battles` 
SET 
`title`='".$title."',
`text1`='".$text1."',
`text2`='".$text2."',
`text3`='".$text3."',
`zagol1`='".$zagol1."',
`zagol2`='".$zagol2."',
`zagol3`='".$zagol3."',
`timestop`='".$timestop."'
WHERE id='".$bid."'
";
dbQuery($sql);
$inCore->redirect('?view=components&do=config&id='.(int)$_REQUEST['id'].'&opt=list'); // уходим отсюда
}
?>
