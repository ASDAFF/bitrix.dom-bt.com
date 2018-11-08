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
?>
<?if(!empty($arResult["ITEMS"]) && (1==2)): //закрыл стандартный блок соцсетей, чтобы вывести свои стилизованные облегчённые иконки  ?>
<ul class="list-inline smt-social ws1">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); 
?>
<li>
	<a class="smt-social__icon" id="<?=$this->GetEditAreaId($arItem['ID']);?>" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank" rel="nofollow"><span class="<?=$arItem["PROPERTIES"]["ICON"]["VALUE"]?>"></span></a>
</li>
<?endforeach;?>
</ul>
<?endif;?>
<ul class="list-inline smt-social">
    <li>
        <a class="smt-social__icon" href="https://vk.com/public173408980" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#vk" alt="VKontakte" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://www.facebook.com/EvropaDom/" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#fb" alt="Facebook" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://www.instagram.com/evropeiskiidom/" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#insta" alt="Instagram" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://www.youtube.com/c/%D0%95%D0%B2%D1%80%D0%BE%D0%BF%D0%B5%D0%B9%D1%81%D0%BA%D0%B8%D0%B9%D0%94%D0%BE%D0%BC" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#youtube" alt="Youtube" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://twitter.com/evropeyskiydom" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#twitter" alt="twitter" style="width: 32px;">
        </a>
    </li>
</ul>
<ul class="list-inline smt-social">
    <li>
        <a class="smt-social__icon" href="https://ok.ru/group/55808558039065" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#ok" alt="Одноклассники" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://plus.google.com/u/0/communities/104308811347148379402" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#g-plus" alt="Google+" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://my.mail.ru/community/europadom/" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#mir" alt="Мой Мир" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="https://www.pinterest.ru/dombtcom/" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#pinterest" alt="Pinterest" style="width: 32px;">
        </a>
    </li>
    <li>
        <a class="smt-social__icon" href="#" target="_blank" rel="nofollow noopener">
            <img src="/smt_images/social_icons_ws4.svg#linkedin" alt="LinkedIn" style="width: 32px;">
        </a>
    </li>
</ul>