<?
if(!defined('VALID_CMS')) { die('ACCESS DENIED'); } // доступ

    $inCore     = cmsCore::getInstance();
    $inDB       = cmsDatabase::getInstance();
    $inPage     = cmsPage::getInstance();
    $cfg        = $inCore->loadComponentConfig('battles');
    $inUser     = cmsUser::getInstance();$key=$cfg['key'];
	$action     = $inCore->request('action', 'str', 'view');
	$zapros     = $inCore->request('zapros', 'str', 'view'); 


if($action=='view') { // вывод

$sql = "
		SELECT id, title
		FROM `cms_battles` WHERE published='1'
";
$res=$inDB->query($sql);
		while ($row = mysql_fetch_array($res)) {
echo '<a href="/battles/tur/'.$row['id'].'">'.$row['title'].'</a><br>';
		}
} 	
if($action=='tur') { // вывод 	
?>
<link rel="stylesheet" type="text/css" href="/components/battles/js/style.css">
<script type="text/javascript" src="/components/battles/js/jquery-1.js"></script>
<script type="text/javascript" src="/components/battles/js/countdown.js"></script>
<script type="text/javascript" src="/components/battles/js/openapi.js"></script>
<?
$sql = "
		SELECT * 
		FROM `cms_battles`
		WHERE `id`=".$zapros." AND published='1'
";
$res=$inDB->query($sql);
		while ($row = mysql_fetch_array($res)) {
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
$col='3';
} else {
$col='2';
}
$Y=date("Y", strtotime($row['timestop']));
$m=date("m", strtotime($row['timestop']));
$d=date("d", strtotime($row['timestop']));
$H=date("H", strtotime($row['timestop']));
$i=date("i", strtotime($row['timestop']));
$s=date("s", strtotime($row['timestop']));
		}
$inPage->addPathway($title, '');	
$inPage->setTitle($title); // вывод титла на страницах
$stext1=str_replace("\r\n",' ',$text1);
$stext2=str_replace("\r\n",' ',$text2);
$stext3=str_replace("\r\n",' ',$text3);
?>
<script type="text/javascript">
var mailru_text_1 = facebook_text_1 = vkontakte_text_1 = "<?=$stext1;?>";
var mailru_title_1 = facebook_title_1 = twitter_title_1 = vkontakte_title_1 = "<?=$zagol1;?>"; 
var mailru_url_1 = facebook_url_1 = twitter_url_1 = vkontakte_url_1 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$zapros;?>-1"; 
var mailru_image_1 = facebook_image_1 = vkontakte_image_1 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file1;?>";

var mailru_text_2 = facebook_text_2 = vkontakte_text_2 = "<?=$stext2;?>";
var mailru_title_2 = facebook_title_2 = twitter_title_2 = vkontakte_title_2 = "<?=$zagol2;?>";
var mailru_url_2 = facebook_url_2 = twitter_url_2 = vkontakte_url_2 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$zapros;?>-2";
var mailru_image_2 = facebook_image_2 = vkontakte_image_2 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file2;?>"; 

<?php
if ($text3) {
?>
var mailru_text_3 = facebook_text_3 = vkontakte_text_3 = "<?=$stext3;?>";
var mailru_title_3 = facebook_title_3 = twitter_title_3 = vkontakte_title_3 = "<?=$zagol3;?>";
var mailru_url_3 = facebook_url_3 = twitter_url_3 = vkontakte_url_3 = "http://<?=$_SERVER['SERVER_NAME'];?>/battles/vote/<?=$zapros;?>-3";
var mailru_image_3 = facebook_image_3 = vkontakte_image_3 = "http://<?=$_SERVER['SERVER_NAME'];?>/images/battles/<?=$file3;?>"; 
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

<?php 
$image_1 = '/images/battles/'.$file1.''; 
$image_2 = '/images/battles/'.$file2.'';
$image_3 = '/images/battles/'.$file3.'';
?>


<script src="/components/battles/js/jquery.js"></script>
<script type="text/javascript">
var id_brand = 0;
var iterations = 0;
var total_count = new Array();
total_count[11] = 0;
total_count[12] = 0;
total_count[13] = 0;

var social = new Array();
var texts = new Object();

texts.facebook = new Array();
texts.facebook[11] = new Object();
texts.facebook[11].summary = facebook_text_1;
texts.facebook[11].title = facebook_title_1;
texts.facebook[11].url = facebook_url_1;
texts.facebook[11].image = facebook_image_1;

texts.facebook[12] = new Object();
texts.facebook[12].summary = facebook_text_2;
texts.facebook[12].title = facebook_title_2;
texts.facebook[12].url = facebook_url_2;
texts.facebook[12].image = facebook_image_2;
<? if ($text3){ ?>
texts.facebook[13] = new Object();
texts.facebook[13].summary = facebook_text_3;
texts.facebook[13].title = facebook_title_3;
texts.facebook[13].url = facebook_url_3;
texts.facebook[13].image = facebook_image_3;
<? } ?>
texts.twitter = new Array();
texts.twitter[11] = new Object();
texts.twitter[11].title = twitter_title_1;
texts.twitter[11].url = twitter_url_1;

texts.twitter[12] = new Object();
texts.twitter[12].title = twitter_title_2;
texts.twitter[12].url = twitter_url_2;
<? if ($text3){ ?>
texts.twitter[13] = new Object();
texts.twitter[13].title = twitter_title_3;
texts.twitter[13].url = twitter_url_3;
<? } ?>

texts.vkontakte = new Array();
texts.vkontakte[11] = new Object();
texts.vkontakte[11].summary = vkontakte_text_1;
texts.vkontakte[11].title = vkontakte_title_1;
texts.vkontakte[11].url = vkontakte_url_1;
texts.vkontakte[11].image = vkontakte_image_1;
texts.vkontakte[12] = new Object();
texts.vkontakte[12].summary = vkontakte_text_2;
texts.vkontakte[12].title = vkontakte_title_2;
texts.vkontakte[12].url = vkontakte_url_2;
texts.vkontakte[12].image = vkontakte_image_2;

<? if ($text3){ ?>
texts.vkontakte[13] = new Object();
texts.vkontakte[13].summary = vkontakte_text_3;
texts.vkontakte[13].title = vkontakte_title_3;
texts.vkontakte[13].url = vkontakte_url_3;
texts.vkontakte[13].image = vkontakte_image_3;
<? } ?>


texts.mailru = new Array();
texts.mailru[11] = new Object();
texts.mailru[11].summary = mailru_text_1;
texts.mailru[11].title = mailru_title_1;
texts.mailru[11].url = mailru_url_1;
texts.mailru[11].image = mailru_image_1;

texts.mailru[12] = new Object();
texts.mailru[12].summary = mailru_text_2;
texts.mailru[12].title = mailru_title_2;
texts.mailru[12].url = mailru_url_2;
texts.mailru[12].image = mailru_image_2;
<? if ($text3){ ?>
texts.mailru[13] = new Object();
texts.mailru[13].summary = mailru_text_3;
texts.mailru[13].title = mailru_title_3;
texts.mailru[13].url = mailru_url_3;
texts.mailru[13].image = mailru_image_3;
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

function voteMailru(){

	var url = "http://connect.mail.ru/share?title="+encodeURIComponent(texts.mailru[id_brand].title)+"&description="+encodeURIComponent(texts.vkontakte[id_brand].summary)+"&url="+encodeURIComponent(texts.mailru[id_brand].url)+"&image="+encodeURIComponent(texts.mailru[id_brand].image)+"&nocache-"+randomString(8);
	
	window.open(url,'','toolbar=1,status=1,width=626,height=436');
	
}


function showSocial(){
	
//		if(social[id_brand] !== false){		
//			$('#social-facebook').attr('href',social[id_brand].facebook);
//			$('#social-twitter').attr('href',social[id_brand].twitter);
//			$('#social-vkontakte').attr('href',social[id_brand].vkontakte);
//			$('#sw').show();
//			$('#lw').hide();			
//		}else{
			$.modal.close();
//		}
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
		calculateFB(11);
		calculateFB(12);
		<? if ($text3){ ?>
		calculateFB(13);
		<? } ?>
		calculateTwitter(11);
		calculateTwitter(12);
		<? if ($text3){ ?>
		calculateTwitter(13);
		<? } ?>
		calculateVkontakte(11);
		calculateVkontakte(12);
		<? if ($text3){ ?>
		calculateVkontakte(13);
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
months:  ['мес€ц', 'мес€ца', 'мес€цев'],
days:    ['день', 'дн€', 'дней'],
hours:   ['час', 'часа', 'часов'],
minutes: ['минута', 'минуты', 'минут'],
seconds: ['секунда', 'секунды', 'секунд'],
plurar:  function(n) {
return (n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);

		//years:   ['год', 'лет'],
		//months:  ['мес€ц', 'мес€цев'],
		//days:    ['день', 'дней'],
		//hours:   ['час', 'часов'],
		//minutes: ['минута', 'минут'],
		//seconds: ['секунда', 'секунд'],
		//plurar:  function(n) {
		//	return (n == 1 ? 0 : 1);
		}
	}
$(document).ready(function(){
	$("#countdown").countdown(new Date(year_vote, month_vote, day_vote, hour_vote, minute_vote, seconds_vote), {suffix:'',prefix:'Осталось<br>', finish: '',lang:lang});
	// $("#mini-countdown").countdown(new Date(2011, 2, 26, 23, 59, 59), {suffix:'',prefix:'ќсталось', finish: '',lang:lang});
	calculateStart();
});

function showLogin(b){
	id_brand = b;
	$('#login-window').modal({});
	$('#lw').show();
}
</script>
<table width="100%" align="center">
	<tr>
		<td align="center">
		<div id="brand-1-wrapper"><?php echo $zagol1; ?><br>
		<img src=<?php echo $image_1; ?> style="text-align: center;" width="150"><br><?php echo $text1; ?><br>
		<div class="brand-votes">
		<b id="c11">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(11)" type="button"></div>
		</td>
		<td align="center">
		<div id="brand-2-wrapper"><?php echo $zagol2; ?><br>
		<img src=<?php echo $image_2; ?> style="text-align: center;" width="150"><br><?php echo $text2; ?><br>
		<div class="brand-votes">
		<b id="c12">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(12)" type="button"></div>
		</td>
<?php
if ($text3) {

?>
		<td align="center">
		<div id="brand-3-wrapper"><?php echo $zagol1; ?><br>
		<img src=<?php echo $image_3; ?> style="text-align: center;" width="150"><br><?php echo $text3; ?><br>
		<div class="brand-votes">
		<b id="c13">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(13)" type="button"></div>
		</td>
<?php
}
?>
	</tr>
	<tr>
		<td align="center" colspan="<?=$col;?>">
<div class="clear"></div>
<div id="countdown"></div>
<div class="clear"></div>
<div id="login-window" style="display:none">
<a href="javascript:void(0)" onclick="$.modal.close();" id="close"></a>
<center id="lw">Выберите по очереди каждый из вариантов:<br>
<img src="/components/battles/img/facebook.png" onclick="voteFacebook(); showSocial();"> 
<img src="/components/battles/img/twitter.png" onclick="voteTwitter(); showSocial();">
<img src="/components/battles/img/vkontakte.png" onclick="voteVkontakte(); showSocial();">
<!-- <img src="/components/battles/img/mailru.png" onclick="voteMailru(); showSocial();"> -->
<br>проголосуйте с помощью всех<br> аккаунтов в социальных сетях.
</center>
</div>

		</td>
	</tr>
</table>

<?
}
if($action=='vote') { // вывод 

list($per, $lin) = split('[-]', $zapros); // отделим путь от названи€
$sql = "
		SELECT link".$lin." AS kuda 
		FROM `cms_battles`
		WHERE `id`=".$per."
";
$res=$inDB->query($sql);
	while ($row = mysql_fetch_array($res)) {
		if ($row['kuda']) {
			$inCore->redirect('http://'.$row['kuda'].''); // уходим отсюда	 
		} else { 
			$inCore->redirect('/battles/tur/'.$per.''); // уходим отсюда	
		}			
	}
}

?>