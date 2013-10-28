{extends file="wrappers/main.tpl"}
{block name=headerAdditional}
<title></title>
{/block}

{block name=styleAdditional}
<link rel="stylesheet" href="{$themeUrl}resources/css/home.css">
{/block}

{block name=content}
<div class="content-block">
	<section class="newsletter">
		<header><h1 class="page-title"></h1></header>

		<div class="content">
			<ul class="reset-ul">
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">2013台灣國際綠色產業展</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">第4屆馬來西亞國際綠色科技及環保產品展(IGEM2013)</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">2013台南生技綠能博覽會</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">環保及綠建築產業拓銷團</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">「海外參展須知及中小企業投資融資輔導介紹」研討會</span></a></li>
			</ul>
		</div>
	</section>

	<section class="member">
		<header><h1 class="page-title"></h1></header>

		<div class="content clearfix">
			<a href="members.html">節能設計</a>
			<a href="members.html">系統設備</a>
			<a href="members.html">綠色能源</a>
			<a href="members.html">能源管理</a>
		</div>
	</section>
</div>

<div class="sidebar">
	<a href="join-alliance.html"></a>
	<a href="news.html"></a>
	<a href="products.html"></a>
</div>
{/block}