{* ================================================================================ *}

{* ================================================================================ *}
<link rel="stylesheet" type="text/css" href="/components/battles/js/style.css">
<script type="text/javascript" src="/components/battles/js/jquery-1.js"></script>
<script type="text/javascript" src="/components/battles/js/countdown.js"></script>
<script type="text/javascript" src="/components/battles/js/openapi.js"></script>
{literal} 
<script src="/components/battles/js/jquery.js"></script>
{/literal} 
{foreach item=batl from=$batls}
<table width="100%" align="center">
	<tr>
		<td align="center">
		<div id="brand-1-wrapper">{$batl.zagol1}<br>
		<img src=/images/battles/{$batl.files1} style="text-align: center;" width="150"><br>{$batl.text1}<br>
		<div class="brand-votes">
		<b id="c11">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(11)" type="button"></div>
		</td>
		<td align="center">
		<div id="brand-2-wrapper">{$batl.zagol2}<br>
		<img src=/images/battles/{$batl.files2} style="text-align: center;" width="150"><br>{$batl.text2}<br>
		<div class="brand-votes">
		<b id="c12">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(12)" type="button"></div>
		</td>
{if $batl.col==3}
		<td align="center">
		<div id="brand-3-wrapper">{$batl.zagol3}<br>
		<img src=/images/battles/{$batl.files3} style="text-align: center;" width="150"><br>{$batl.text3}<br>
		<div class="brand-votes">
		<b id="c13">0</b>
		<span>голосов</span>
		</div>
		<input class="vote" value="Голосовать" onclick="showLogin(13)" type="button"></div>
		</td>
{/if}
	</tr>
	<tr>
		<td align="center" colspan="{$batl.col}">
<div class="clear"></div>
<div id="countdown"></div>
<div class="clear"></div>
<div id="login-window" style="display:none">
<a href="javascript:void(0)" onclick="$.modal.close();" id="close"></a>
<center id="lw">Выберите по очереди каждый из вариантов:<br>
<img src="/components/battles/img/facebook.png" onclick="voteFacebook(); showSocial();"> 
<img src="/components/battles/img/twitter.png" onclick="voteTwitter(); showSocial();">
<img src="/components/battles/img/vkontakte.png" onclick="voteVkontakte(); showSocial();">
<br>Проголосуйте с помощью всех<br> аккаунтов в социальных сетях.</center>
</div>

		</td>
	</tr>
</table>
{/foreach}
