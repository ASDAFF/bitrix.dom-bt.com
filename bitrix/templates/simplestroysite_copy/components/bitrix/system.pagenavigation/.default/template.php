<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

	// START WebSEO.kz Michael Nossov:
	$wsasset = \Bitrix\Main\Page\Asset::getInstance();
	$ws_uri_protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	//$wsuri = $ws_uri_protocol . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $APPLICATION->GetCurPage(true));
	$wsuri = $ws_uri_protocol . $_SERVER['HTTP_HOST'] . $arResult["sUrlPath"];
	if ($arResult["NavPageNomer"] != 1) {
		// если это не первая страница, то добавляем метатег rel=prev
		// только к первой не добавляется окончание ?PAGEN_1=1
		$wspprev = '';
		if($arResult["NavPageNomer"] != 2){
			$wspprev = '?PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
		}
		$wsasset->addString('<link rel="prev" href="' . $wsuri . $wspprev.'">');
		
		$wsasset->addString('<link rel="canonical" href="' . $wsuri . '?PAGEN_'.$arResult["NavNum"].'='.$arResult["NavPageNomer"].'">');
	}
	else{
		$wsasset->addString('<link rel="canonical" href="' . $wsuri . '">');
    }
	if($arResult["NavPageNomer"] != $arResult["NavPageCount"]) {
		// если это не последняя страница, то добавляем метатег rel=next
		$wsasset->addString('<link rel="next" href="' . $wsuri . '?PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1).'">');
	}
	// END WebSEO.kz
 
?>
<ul class="smt-pagination">
<?if($arResult["bDescPageNumbering"] === true):?>
	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<li class="smt-pagination__first"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("smt_nav_begin")?></a></li>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("smt_nav_prev")?></a></li>
		<?else:?>
			<li class="smt-pagination__first"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("smt_nav_begin")?></a></li>
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("smt_nav_prev")?></a></li>
			<?else:?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("smt_nav_prev")?></a></li>
			<?endif?>
		<?endif?>
	<?else:?>
		<li class="smt-pagination__first"><a href="#"><?=GetMessage("smt_nav_begin")?></a></li>
        <li><a href="#"><?=GetMessage("smt_nav_prev")?></a></li>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<li class="active"><a href="#"><?=$NavRecordGroupPrint?></a></li>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
		<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	<?if ($arResult["NavPageNomer"] > 1):?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("smt_nav_next")?></a></li>
		<li class="smt-pagination__last"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("smt_nav_end")?></a></li>
	<?else:?>
        <li><a href="#"><?=GetMessage("smt_nav_next")?></a></li>
        <li class="smt-pagination__last"><a href="#"><?=GetMessage("smt_nav_end")?></a></li>
	<?endif?>

<?else:?>
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if($arResult["bSavePage"]):?>
			<li class="smt-pagination__first"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("smt_nav_begin")?></a></li>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("smt_nav_prev")?></a></li>
		<?else:?>
			<li class="smt-pagination__first"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("smt_nav_begin")?></a></li>
			<?if ($arResult["NavPageNomer"] > 2):?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("smt_nav_prev")?></a></li>
			<?else:?>
                <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("smt_nav_prev")?></a></li>
			<?endif?>
		<?endif?>
	<?else:?>
		<li class="smt-pagination__first"><a href="#" class="disabled"><?=GetMessage("smt_nav_begin")?></a></li>
        <li><a href="#"><?=GetMessage("smt_nav_prev")?></a></li>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<li class="active"><a href="#"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("smt_nav_next")?></a></li>
        <li class="smt-pagination__last"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("smt_nav_end")?></a></li>
	<?else:?>
        <li><a href="#"><?=GetMessage("smt_nav_next")?></a></li>
        <li class="smt-pagination__last"><a href="#"><?=GetMessage("smt_nav_end")?></a></li>
	<?endif?>
<?endif?>

<?if ($arResult["bShowAll"]):?>
	<?if ($arResult["NavShowAll"]):?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("smt_nav_paged")?></a></li>
	<?else:?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("smt_nav_all")?></a></li>
	<?endif?>
<?endif?>
</ul>
