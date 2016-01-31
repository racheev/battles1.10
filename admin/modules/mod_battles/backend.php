<?php
	if (isset($_REQUEST['opt'])) { $opt = $_REQUEST['opt']; } else { $opt = 'config'; }
	echo '<h3>Битвы титанов</h3>';
    
 		$toolmenu = array();
		$toolmenu[0]['icon'] = 'save.gif';
		$toolmenu[0]['title'] = 'Сохранить';
		$toolmenu[0]['link'] = 'javascript:document.optform.submit();';

		$toolmenu[1]['icon'] = 'edit.gif';
		$toolmenu[1]['title'] = 'Редактировать отображение модуля';
		$toolmenu[1]['link'] = '?view=modules&do=edit&id='.$_REQUEST['id'];				

		$toolmenu[2]['icon'] = 'cancel.gif';
		$toolmenu[2]['title'] = 'Отмена';
		$toolmenu[2]['link'] = '?view=modules';		
		cpToolMenu($toolmenu);
    //LOAD CURRENT CONFIG
    $cfg = $inCore->loadModuleConfig($_REQUEST['id']);
	if($opt=='save'){
		$cfg = array();
		$cfg['bid']        = $inCore->request('bid', 'str', '0');
        $inCore->saveModuleConfig($_REQUEST['id'], $cfg);
		$msg = 'Настройки сохранены.';
	}    
    if (!isset($cfg['bid'])) { $cfg['bid'] = '0'; }	
	if (@$msg) { echo '<p class="success">'.$msg.'</p>'; }

$sql = "
		SELECT id, title 
		FROM `cms_battles`
		WHERE published='1'
";
$res=$inDB->query($sql);
		while ($row = mysql_fetch_array($res)) {
		if ($cfg['bid']==$row['id']) {
		$select=' selected="selected"';
		} else {$select='';}
		$option.='<option value="'.$row['id'].'"'.$select.'>'.$row['title'].'</option>';
		}
?>

<form action="index.php?view=modules&do=config&id=<?php echo $_REQUEST['id'];?>" method="post" name="optform" target="_self" id="optform">
    <table width="546" border="0" cellpadding="10" cellspacing="0" class="proptable">
		<tr>
            <td><strong>Что будем выводить: </strong><br>Вы создали модуль, теперь выберите то что задумали в созданом модуле.</td>
            <td>
                <select name="bid">
                    <option>-- Выбираем --</option>
                    <?=$option;?>
                </select>
            </td>
        </tr>
    </table>
    <p>
        <input name="opt" type="hidden" id="do" value="save" />
        <input name="save" type="submit" id="save" value="Сохранить" />
        <input name="back" type="button" id="back" value="Назад" onclick="window.location.href='index.php?view=modules';"/>
    </p>
</form>
<?
	cpAddPathway('Битвы титанов', '?view=modules&do=edit&id='.$_REQUEST['id']);
	cpAddPathway('Настройки', '?view=modules&do=config&id='.$_REQUEST['id']);
?>