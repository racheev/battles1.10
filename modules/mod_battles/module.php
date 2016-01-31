<?php
function mod_battles($module_id){
        $inCore = cmsCore::getInstance();
        $inDB = cmsDatabase::getInstance();
		$config = $inCore->loadComponentConfig('battles');
		$cfg = $inCore->loadModuleConfig($module_id);	


		if (!isset($cfg['bid'])) { 
		echo 'Модуль не настроен.';
		$cfg['bid']='0';
		} else {
		$sql =  "SELECT *
				 FROM cms_battles
				 WHERE published = 1 AND id=".$cfg['bid']."";
		$result = $inDB->query($sql);					
		if ($inDB->num_rows($result)){		
			while ($row = $inDB->fetch_assoc($result)){
$title=$row['title'];
$text1=$row['text1'];
$text2=$row['text2'];
$text3=$row['text3'];
$file1=$row['files1'];
$file2=$row['files2'];
$file3=$row['files3'];
$zagol1=$row['zagol1'];
$zagol2=$row['zagol2'];
$zagol3=$row['zagol3'];
if ($text3){
$row['col']='3';
} else {
$row['col']='2';
}
$Y=date("Y", strtotime($row['timestop']));
$m=date("m", strtotime($row['timestop']));
$d=date("d", strtotime($row['timestop']));
$H=date("H", strtotime($row['timestop']));
$i=date("i", strtotime($row['timestop']));
$s=date("s", strtotime($row['timestop']));
				$batls[] = $row;
}	
$bid=$cfg['bid'];
$stext1=str_replace("\r\n",' ',$text1);
$stext2=str_replace("\r\n",' ',$text2);
$stext3=str_replace("\r\n",' ',$text3);
?>
<script type="text/javascript">
var facebook_text_<?=$bid;?>1 = vkontakte_text_<?=$bid;?>1 = "<?=$stext1;?>";
var facebook_title_<?=$bid;?>1 = twitter_title_<?=$bid;?>1 = vkontakte_title_<?=$bid;?>1 = "<?=$zagol1;?>"; 
var facebook_url_<?=$bid;?>1 = twitter_url_<?=$bid;?>1 = vkontakte_url_<?=$bid;?>1 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$cfg['bid'];?>-1"; 
var facebook_image_<?=$bid;?>1 = vkontakte_image_<?=$bid;?>1 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file1;?>";

var facebook_text_<?=$bid;?>2 = vkontakte_text_<?=$bid;?>2 = "<?=$stext2;?>";
var facebook_title_<?=$bid;?>2 = twitter_title_<?=$bid;?>2 = vkontakte_title_<?=$bid;?>2 = "<?=$zagol2;?>";
var facebook_url_<?=$bid;?>2 = twitter_url_<?=$bid;?>2 = vkontakte_url_<?=$bid;?>2 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$cfg['bid'];?>-2";
var facebook_image_<?=$bid;?>2 = vkontakte_image_<?=$bid;?>2 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file2;?>"; 

<?php
if ($text3) {
?>
var facebook_text_<?=$bid;?>3 = vkontakte_text_<?=$bid;?>3 = "<?=$stext3;?>";
var facebook_title_<?=$bid;?>3 = twitter_title_<?=$bid;?>3 = vkontakte_title_<?=$bid;?>3 = "<?=$zagol3;?>";
var facebook_url_<?=$bid;?>3 = twitter_url_<?=$bid;?>3 = vkontakte_url_<?=$bid;?>3 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$cfg['bid'];?>-3";
var facebook_image_<?=$bid;?>3 = vkontakte_image_<?=$bid;?>3 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file3;?>"; 
<?php
}
?>

var year_vote = "<?=$Y?>"; 
var month_vote = "<?=$m?>"-1; 
var day_vote = "<?=$d?>";
var hour_vote = "<?=$H?>";
var minute_vote = "<?=$i?>";
var seconds_vote = "<?=$s?>";
</script>

<script type="text/javascript">
var id_brand = 0;
var iterations = 0;
var total_count = new Array();
total_count[<?=$bid;?>1] = 0;
total_count[<?=$bid;?>2] = 0;
<?php if ($text3) { ?>
total_count[<?=$bid;?>3] = 0;
<? } ?>
var social = new Array();
var texts = new Object();

texts.facebook = new Array();
texts.facebook[<?=$bid;?>1] = new Object();
texts.facebook[<?=$bid;?>1].summary = facebook_text_<?=$bid;?>1;
texts.facebook[<?=$bid;?>1].title = facebook_title_<?=$bid;?>1;
texts.facebook[<?=$bid;?>1].url = facebook_url_<?=$bid;?>1;
texts.facebook[<?=$bid;?>1].image = facebook_image_<?=$bid;?>1;

texts.facebook[<?=$bid;?>2] = new Object();
texts.facebook[<?=$bid;?>2].summary = facebook_text_<?=$bid;?>2;
texts.facebook[<?=$bid;?>2].title = facebook_title_<?=$bid;?>2;
texts.facebook[<?=$bid;?>2].url = facebook_url_<?=$bid;?>2;
texts.facebook[<?=$bid;?>2].image = facebook_image_<?=$bid;?>2;
<?php if ($text3) { ?>
texts.facebook[<?=$bid;?>3] = new Object();
texts.facebook[<?=$bid;?>3].summary = facebook_text_<?=$bid;?>3;
texts.facebook[<?=$bid;?>3].title = facebook_title_<?=$bid;?>3;
texts.facebook[<?=$bid;?>3].url = facebook_url_<?=$bid;?>3;
texts.facebook[<?=$bid;?>3].image = facebook_image_<?=$bid;?>3;
<? } ?>
texts.twitter = new Array();
texts.twitter[<?=$bid;?>1] = new Object();
texts.twitter[<?=$bid;?>1].title = twitter_title_<?=$bid;?>1;
texts.twitter[<?=$bid;?>1].url = twitter_url_<?=$bid;?>1;

texts.twitter[<?=$bid;?>2] = new Object();
texts.twitter[<?=$bid;?>2].title = twitter_title_<?=$bid;?>2;
texts.twitter[<?=$bid;?>2].url = twitter_url_<?=$bid;?>2;
<?php if ($text3) { ?>
texts.twitter[<?=$bid;?>3] = new Object();
texts.twitter[<?=$bid;?>3].title = twitter_title_<?=$bid;?>3;
texts.twitter[<?=$bid;?>3].url = twitter_url_<?=$bid;?>3;
<? } ?>
texts.vkontakte = new Array();
texts.vkontakte[<?=$bid;?>1] = new Object();
texts.vkontakte[<?=$bid;?>1].summary = vkontakte_text_<?=$bid;?>1;
texts.vkontakte[<?=$bid;?>1].title = vkontakte_title_<?=$bid;?>1;
texts.vkontakte[<?=$bid;?>1].url = vkontakte_url_<?=$bid;?>1;
texts.vkontakte[<?=$bid;?>1].image = vkontakte_image_<?=$bid;?>1;
texts.vkontakte[<?=$bid;?>2] = new Object();
texts.vkontakte[<?=$bid;?>2].summary = vkontakte_text_<?=$bid;?>2;
texts.vkontakte[<?=$bid;?>2].title = vkontakte_title_<?=$bid;?>2;
texts.vkontakte[<?=$bid;?>2].url = vkontakte_url_<?=$bid;?>2;
texts.vkontakte[<?=$bid;?>2].image = vkontakte_image_<?=$bid;?>2;
<?php if ($text3) { ?>
texts.vkontakte[<?=$bid;?>3] = new Object();
texts.vkontakte[<?=$bid;?>3].summary = vkontakte_text_<?=$bid;?>3;
texts.vkontakte[<?=$bid;?>3].title = vkontakte_title_<?=$bid;?>3;
texts.vkontakte[<?=$bid;?>3].url = vkontakte_url_<?=$bid;?>3;
texts.vkontakte[<?=$bid;?>3].image = vkontakte_image_<?=$bid;?>3;
<? } ?>
function randomString(length) {    
	var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
	if (! length) {        length = Math.floor(Math.random() * chars.length);    }    var str = ''; for (var i = 0; i < length; i++) {        str += chars[Math.floor(Math.random() * chars.length)];    }    return str;
} 

function voteFacebook(){
	var url = "http://www.facebook.com/sharer.php?s=100&p[title]="+encodeURIComponent(texts.facebook[id_brand].title)+"&p[summary]="+encodeURIComponent(texts.facebook[id_brand].summary)+"&p[url]="+encodeURIComponent(texts.facebook[id_brand].url)+"&p[images][0]="+encodeURIComponent(texts.facebook[id_brand].image)+"&nocache-"+randomString(8);
	window.open(url,'','toolbar=0,status=0,width=626,height=436');
	
}

function voteVkontakte(){
	var url = "http://vkontakte.ru/share.php?title="+encodeURIComponent(texts.vkontakte[id_brand].title)+"&description="+encodeURIComponent(texts.vkontakte[id_brand].summary)+"&url="+encodeURIComponent(texts.vkontakte[id_brand].url)+"&image="+encodeURIComponent(texts.vkontakte[id_brand].image)+"&nocache-"+randomString(8);
	window.open(url,'','toolbar=0,status=0,width=626,height=436');
	
}

function voteTwitter(){
	var url = "http://twitter.com/share?text="+encodeURIComponent(texts.twitter[id_brand].title)+"&url="+encodeURIComponent(texts.twitter[id_brand].url)+"&counturl="+encodeURIComponent(texts.twitter[id_brand].url)+"&nocache-"+randomString(8);
	window.open(url,'','toolbar=0,status=0,width=626,height=436');
	
}

function showSocial(){
			$.modal.close();
}

function calculateFB(idbrand){
		var facebook = 'https://api.facebook.com/method/fql.query?query=select total_count from link_stat where url="' +encodeURIComponent(texts.facebook[idbrand].url)  + '"&format=json&callback=?';
		 $.getJSON(facebook, function(data) {			
				upCounter([idbrand],data[0].total_count);
				
	     });		

}

function calculateTwitter(idbrand){
		var twitter = 'http://urls.api.twitter.com/1/urls/count.json?url=' +encodeURIComponent(texts.twitter[idbrand].url)  + '&callback=?';
			$.getJSON(twitter, function(data) {			
				upCounter([idbrand],data.count);
				
	     });	
}

function calculateVkontakte(idbrand){
		var vkontakte = 'http://vkontakte.ru/share.php?act=count&index='+idbrand+'&url=' +encodeURIComponent(texts.vkontakte[idbrand].url)  + '&callback=?';
		VK = new Object();
		VK.Share = {};
		VK.Share.count = function(index, count) {
			upCounter([index],count);
		}
		$.getJSON(vkontakte, function(data) {	    });	
}


function calculateStart(){
	calculateFB(<?=$bid;?>1);
	calculateFB(<?=$bid;?>2);
	<?php if ($text3) { ?>
	calculateFB(<?=$bid;?>3);
	<? } ?>
	calculateTwitter(<?=$bid;?>1);
	calculateTwitter(<?=$bid;?>2);
	<?php if ($text3) { ?>
	calculateTwitter(<?=$bid;?>3);
	<? } ?>
	calculateVkontakte(<?=$bid;?>1);
	calculateVkontakte(<?=$bid;?>2);
	<?php if ($text3) { ?>
	calculateVkontakte(<?=$bid;?>3);
	<? } ?>
		}

function upCounter(id,count){
	total_count[id]+=count;

	if(document.all){
		document.getElementById('c'+id).innerText = total_count[id];
	} else{
		document.getElementById('c'+id).textContent = total_count[id];
	}
	
}

var lang = {
years:   ['год', 'года', 'лет'],
months:  ['месяц', 'месяца', 'месяцев'],
days:    ['день', 'дня', 'дней'],
hours:   ['час', 'часа', 'часов'],
minutes: ['минута', 'минуты', 'минут'],
seconds: ['секунда', 'секунды', 'секунд'],
plurar:  function(n) {
return (n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
		}
	}
$(document).ready(function(){
	$("#countdown").countdown(new Date(year_vote, month_vote, day_vote, hour_vote, minute_vote, seconds_vote), {suffix:'',prefix:'Oсталось<br>', finish: '',lang:lang});
	// $("#mini-countdown").countdown(new Date(2011, 2, 26, 23, 59, 59), {suffix:'',prefix:'ќсталось', finish: '',lang:lang});
	calculateStart();
});

function showLogin(b){
	id_brand = b;
	$('#login-window').modal({});
	$('#lw').show();
}
</script>
<?	//$cfgs[] = $cfg;

			$smarty = $inCore->initSmarty('modules', 'mod_battles.tpl');			
			$smarty->assign('batls', $batls);
			//$smarty->assign('cfgs', $cfgs);
			$smarty->assign('opisanie', $cfg['opisanie']);
			$smarty->assign('zagolovok', $cfg['zagolovok']);
			$smarty->assign('bid', $bid);
			$smarty->display('mod_battles.tpl');
						
		}		
		return true;
///=====================================================================
	} // есть ли в настройке id
}
?>