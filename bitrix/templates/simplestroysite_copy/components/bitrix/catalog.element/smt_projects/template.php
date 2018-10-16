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
<div class="smt-widget smt-widget_margin">	
    
    <!-- PRICES ROW -->
    <div class="row">
    	
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        	<div class="h3 smt-header smt-header-underline-center pricelist center">            
            <a href="#komplekt" class="price-karkas">
                <span class="smt-price-label">Уютный дом - <br>каркасный домокомплект:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span> 
            </a>                           
            </div>        	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        	<div class="h3 smt-header smt-header-underline-center pricelist center">            
            <a href="#komplekt" class="price-karkas">
                <span class="smt-price-label">Уютный дом - <br>внешний контур:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_VKONTUR_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_VKONTUR"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span> 
            </a>                           
            </div>        	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        	<div class="h3 smt-header smt-header-underline-center pricelist center">
            <a href="#komplekt" class="price-karkas">            
                <span class="smt-price-label">Уютный дом - <br>сезонный каркас:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_KARKAS_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_KARKAS"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span>
            </a>                         
            </div>        	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        	<div class="h3 smt-header smt-header-underline-center pricelist center">
            <a href="#komplekt" class="price-karkas">            
                <span class="smt-price-label">Уютный дом - <br>зимний каркас:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_ZKARKAS_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_ZKARKAS"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span>
            </a>                            
            </div>        	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >        	
        	<div class="h3 smt-header smt-header-underline-center pricelist center">
            <a href="#komplekt" class="price-brus">  
                <span class="smt-price-label">Уютный дом - <br>домокомплект из бруса:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_DK_BRUS_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_DK_BRUS"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span>
            </a> 
            </div>                   	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        	<div class="h3 smt-header smt-header-underline-center pricelist center">
            <a href="#komplekt" class="price-brus">  
                <span class="smt-price-label">Уютный дом - <br>сруб из бруса:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_SRUB_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_SRUB"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span>
            </a> 
            </div>                   	
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        	<div class="h3 smt-header smt-header-underline-center pricelist center"> 
            <a href="#komplekt" class="price-brus">           
                <span class="smt-price-label">Уютный дом - <br>из бруса:</span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_BRUS_OLD"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"> руб.</span></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_BRUS"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> руб.</span> 
            </a>                           
            </div>        	
        </div>        
        
    </div>
    <!-- /PRICES ROW -->
    
    <div class="row">
        <?if($arResult["DETAIL_PICTURE"] || $arResult['GALLERY1'] || $arResult['GALLERY2']):?>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8"> <!-- ширина колонки с главной фотографией -->
            <?if($arParams["SMT_SLIDER"] == "Y"):?>
            <div class="smt-owl-carousel-js smt-photo-gallery-js">
                <div class="owl-carousel owl-theme owl-theme_smt owl-theme_smt-dots<?if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_PROPERTIES_JSON"]?>'<?endif?>>
                    <?if($arResult["DETAIL_PICTURE"]["SRC"] && $arResult["PREVIEW_PICTURE"]["SRC"]):?>
                        <a class="smt-image smt-image-inline-block" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                            <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                            <span class="smt-image__over"></span>
                            <?if($arResult["PROPERTIES"]["LABEL"]["VALUE"]):?>
                                <div class="smt-image-box-inline-label"><?=$arResult["PROPERTIES"]["LABEL"]["VALUE"]?></div>
                            <?endif;?>
                        </a>
                    <?endif?>
                    <?if($arResult['GALLERY1']):?>
                        <?foreach ($arResult['GALLERY1'] as $arItemGallery):?>
                            <a class="smt-image" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
                                <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                                <span class="smt-image__over"></span>
                                <?if($arResult["PROPERTIES"]["LABEL"]["VALUE"]):?>
                                    <div class="smt-image-box-inline-label"><?=$arResult["PROPERTIES"]["LABEL"]["VALUE"]?></div>
                                <?endif;?>
                            </a>
                        <?endforeach;?>
                    <?endif?>
                </div>
            </div>
            <?else:?>
            <div class="smt-photo-gallery-js">
                <?if($arResult["DETAIL_PICTURE"]["SRC"] && $arResult["PREVIEW_PICTURE"]["SRC"]):?>
                <a class="smt-image smt-image-inline-block" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                    <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                    <span class="smt-image__over"></span>
                </a>
                <?endif?>
                <?if($arResult['GALLERY1']):?>
                    <?foreach ($arResult['GALLERY1'] as $arItemGallery):?>
                        <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
                            <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                            <span class="smt-image__over"></span>
                        </a>
                    <?endforeach;?>
                <?endif?>
            </div>
            <?endif?>
            
            
            
        </div>
        <?endif?>
        <?if($arResult["DETAIL_PICTURE"] || $arResult['GALLERY1']):?>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4"> <!-- ширина колонки с таблицей характеристик -->
        <?else:?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?endif?>
        
         <!--
        
        <?if($arParams["DISPLAY_NAME"] == "Y"):?>
            <div class="h2 smt-header smt-header-underline-left"><?=$arResult["NAME"]?></div>
        <?endif?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
            <?if($arResult["PREVIEW_TEXT_TYPE"] == 'text'):?>
                <?if(strlen($arResult["PREVIEW_TEXT"]) > 0):?>
                <p><?=$arResult["PREVIEW_TEXT"]?></p>
                <?endif?>
            <?else:?>
                <?=$arResult["PREVIEW_TEXT"]?>
            <?endif?>
        <?endif?>
        <?if($arParams["DISPLAY_DESCRIPTION"] == "Y"):?>
            <?if($arResult["DETAIL_TEXT_TYPE"] == 'text'):?>
                <?if(strlen($arResult["DETAIL_TEXT"]) > 0):?>
                <p><?=$arResult["DETAIL_TEXT"]?></p>
                <?endif?>
            <?else:?>
                <?=$arResult["DETAIL_TEXT"]?>
            <?endif?>
        <?endif?>
        
       
        <?if($arResult["PROPERTIES"]["PRICE_TEXT"]["VALUE"]):?>
            <div class="h2 smt-header smt-header-underline-left">
                <?$property = $arResult['DISPLAY_PROPERTIES']["PRICE_TEXT"];?>
                <?if(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "HTML"):?>
                    <?=$property['DISPLAY_VALUE']?>
                <?elseif(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "TEXT"):?>
                    <?=$property['VALUE']["TEXT"]?>
                <?else:?>
                    <?=(
                    is_array($property['VALUE'])
                        ? implode(' / ', $property['VALUE'])
                        : $property['VALUE']
                    )?>
                <?endif;?>
                <?unset($property);?>
            </div>
        <?elseif($arResult["PROPERTIES"]["PRICE"]["VALUE"]):?>
            <div class="h2 smt-header smt-header-underline-left">
            <?if($arResult["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"]):?>
                <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
            <?else:?>
                <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                <span class="smt-price"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
            <?endif;?>
            </div>
        <?endif;?>        
        -->        
        
        <?if(!empty($arParams['BUTTON_LIST'])):?>
            <div class="smt-widget smt-widget_margin">
                <div class="row">
                <?foreach ($arParams['BUTTON_LIST'] as $code=>$value):?>
                    <?if(strlen($value) > 0):?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <!-- ширина кнопки над хар-ками проекта -->
                            <a data-object-id="<?=$arResult["ID"]?>" href="<?=isset($arParams['BUTTON_LIST_HREF_' . $code])?$arParams['BUTTON_LIST_HREF_' . $code]:""?>" class="<?=isset($arParams['BUTTON_LIST_CLASS_' . $code])?$arParams['BUTTON_LIST_CLASS_' . $code]:""?>"><?=htmlspecialcharsbx($value)?></a>
                        </div>
                    <?endif?>
                <?endforeach?>
                </div>
            </div>
        <?endif;?>
        
        
        <!-- таблица с характеристиками -->
        <?if(!empty($arResult['PROPERTIES'])):?>
          <table class="table project-table">
          		<tr>
                	<td style='width:60%'><?=$arResult["PROPERTIES"]["AREA_COMMON"]["NAME"]?></td>
                    <td class="td-big-txt"><?=$arResult["PROPERTIES"]["AREA_COMMON"]["VALUE"]?> м&sup2;</td>
                </tr>
               	<tr>
                	<td><?=$arResult["PROPERTIES"]["AREA_BUILDING"]["NAME"]?></td>
                    <td><?=$arResult["PROPERTIES"]["AREA_BUILDING"]["VALUE"]?> м&sup2;</td>
                </tr>
                <tr>
                	<td><div class="project-icon size"></div><div><?=$arResult["PROPERTIES"]["SIZE"]["NAME"]?></div></td>
                    <td><?=$arResult["PROPERTIES"]["SIZE"]["VALUE"]?> м</td>                    
                </tr>
                <tr>
                	<td><div class="project-icon floors"></div><div><?=$arResult["PROPERTIES"]["FLOORS"]["NAME"]?></div></td>
                    <td><?=$arResult["PROPERTIES"]["FLOORS"]["VALUE"]?></td>                    
                </tr>
                <tr>
                	<td><div class="project-icon bedroom"></div><div><?=$arResult["PROPERTIES"]["BEDROOMS"]["NAME"]?></div></td>
                    <td><?=$arResult["PROPERTIES"]["BEDROOMS"]["VALUE"]?></td>                    
                </tr>
                <tr>
                	<td><div class="project-icon livingroom"></div><div><?=$arResult["PROPERTIES"]["NUMBER_ROOMS"]["NAME"]?></div></td>
                    <td><?=$arResult["PROPERTIES"]["NUMBER_ROOMS"]["VALUE"]?></td>                    
                </tr>
                <tr>
                	<td><div class="project-icon wc"></div><div><?=$arResult["PROPERTIES"]["WC"]["NAME"]?></div></td>
                    <td><?=$arResult["PROPERTIES"]["WC"]["VALUE"]?></td>                    
                </tr>                              
                  
                <?foreach ($arResult["PROPERTIES"]["EXTRAS"]["VALUE"] as $property) {                     
                if($property=="Терраса" || $property=="Балкон" || $property=="Веранда"  || $property=="Второй свет" || $property=="Гардеробная" || $property=="Кладовая" || $property=="Эркер" || $property=="Сауна") { ?>    
                    <tr>
                        <td><?php if($property=="Терраса") {
                                    $icon="terrasa";
                                } elseif ($property=="Балкон") {
                                    $icon="balcon";
                                } elseif ($property=="Гараж/навес") {
                                    $icon="garage";
                                } elseif ($property=="Веранда") {
                                    $icon="veranda";
                                } elseif ($property=="Второй свет") {
                                    $icon="secondlight";
                                } elseif ($property=="Гардеробная") {
                                    $icon="wardrobe";
                                } elseif ($property=="Кладовая") {
                                    $icon="store";
                                } elseif ($property=="Эркер") {
                                    $icon="erker";
                                } elseif ($property=="Сауна") {
                                    $icon="sauna";
                                }
                            ?>
                        <div class="project-icon <?=$icon?>"></div><?=$property?>
                        </td>
                        <td>✔                            
                        </td>                    
                    </tr>
                <? }                   
                } ?>
                <? unset($property); ?>
                
                 <tr>
                	<td><?=$arResult["PROPERTIES"]["SROK"]["NAME"]?></td>
                    <td><?=$arResult["PROPERTIES"]["SROK"]["VALUE"]?></td>
                </tr> 
               
                                                
          		 <!-- 
                <?foreach ($arResult['PROPERTIES'] as $property) { ?>
                    <?if (in_array($property['CODE'], $arParams['MAIN_BLOCK_PROPERTY_CODE']) || $arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]) { ?>
                    <tr>
                        <td><?=$property['NAME']?></td>
                        <td><?=(
                            is_array($property['VALUE'])
                                ? implode(' / ', $property['VALUE'])
                                : $property['VALUE']
                            )?>
                            <?if($property["DESCRIPTION"]):?><span class="smt-project-item-descr"><?=$property["~DESCRIPTION"]?></span><?endif?>
                            <?if($property["HINT"]):?><span class="smt-project-item-hint"><?=$property["HINT"]?></span><?endif?>
                        </td>
                    </tr>
                    <? } ?>
                <? } ?>
                <? unset($property); ?>
                -->
            </table>            
            
            
        <?endif;?>
        <!-- / таблица с характеристиками -->
        
            <!-- кнопки ПОД хар-ками проекта -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <!-- ширина кнопки -->
				<!--<a href="#smt-tab-0" data-toggle="tab" aria-controls="smt-tab-0" role="tab" class="btn btn-block smt-btn">Комплектации каркасного дома</a>-->
                <a href="/service/stroitelstvo-karkasnykh-domov/" id="btn-tab-0" class="btn btn-block smt-btn price-karkas">Технология каркасного дома</a>                
            </div>
            <p>&nbsp;</p>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <!-- ширина кнопки -->
				<!--<a href="#smt-tab-1" data-toggle="tab" aria-controls="smt-tab-1" role="tab" class="btn btn-block smt-btn">Комплектации брусового дома</a> --> 
                <a href="/service/stroitelstvo-domov-iz-brusa/" id="btn-tab-1" class="btn btn-block smt-btn price-brus">Технология брусового дома</a>              
            </div>
        
        </div>
    </div>
</div>

<!-- ПЛАНИРОВКИ И ФАСАДЫ -->

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<!-- ПЛАНИРОВКИ И ФАСАДЫ -->
            <?if($arResult['GALLERY2']):?>
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/project_gallery_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?>
                <?if($arParams["SMT_SLIDER_GALLERY"] == "Y"):?>
                    <div class="smt-owl-carousel-js smt-photo-gallery-js">
                        <div class="owl-carousel owl-theme owl-theme_smt owl-theme_smt-dots<?if($arParams["SMT_SLIDER_GALLERY_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_GALLERY_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_GALLERY_PROPERTIES_JSON"]?>'<?endif?>>
                            <?foreach ($arResult['GALLERY2'] as $arItemGallery):?>
                                <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
                                    <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                                    <span class="smt-image__over"></span>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                <?else:?>
                    <div class="smt-photo-gallery-js">
                        <?foreach ($arResult['GALLERY2'] as $arItemGallery):?>
                            <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
                                <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image">
                                <span class="smt-image__over"></span>
                            </a>
                        <?endforeach;?>
                    </div>
                <?endif?>
            <?endif?>
            <!-- / ПЛАНИРОВКИ И ФАСАДЫ -->

</div>
</div>
<!-- / ПЛАНИРОВКИ И ФАСАДЫ -->


<!-- блок с комплектациями -->
<div class="row" style="margin-top: 2em;">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<a name="komplekt"></a>
<h2 class="smt-header smt-header-underline-left">Варианты комплектаций</h2>

<?if(!empty($arParams['TABS_LIST'])):?>
        <div class="smt-widget smt-widget_margin">
            <ul class="nav nav-tabs smt-nav-tabs smt-nav-tabs_colored" role="tablist">
            <?foreach ($arParams['TABS_LIST'] as $code=>$value):?>
                <?if(strlen($value) > 0):?>
                <li<?if($code==0):?> class="active"<?endif?> role="presentation"><a href="#smt-tab-<?=$code?>" data-toggle="tab" aria-controls="smt-tab-<?=$code?>" role="tab"><?=htmlspecialcharsbx($value)?></a></li>
                <?endif?>
            <?endforeach?>
            </ul>
            <div class="tab-content smt-tab-content">
            <?foreach ($arParams['TABS_LIST'] as $code=>$value):?>
                <?if(strlen($value) > 0):?>
                <div class="tab-pane fade<?if($code==0):?> active in<?endif?>" role="tabpanel" id="smt-tab-<?=$code?>">
                    <?if($arParams['TABS_LIST_ITEM_' . $code]):?>
                        <?if($arParams['TABS_LIST_ITEM_' . $code] == 'SMT_DETAIL_TEXT'):?>
                            <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
                                <?if($arResult["DETAIL_TEXT_TYPE"] == 'text'):?>
                                    <p><?=$arResult["DETAIL_TEXT"]?></p>
                                <?else:?>
                                    <?=$arResult["DETAIL_TEXT"]?>
                                <?endif?>
                            <?else:?>
                                <?if($arResult["PREVIEW_TEXT_TYPE"] == 'text'):?>
                                    <p><?=$arResult["PREVIEW_TEXT"]?></p>
                                <?else:?>
                                    <?=$arResult["PREVIEW_TEXT"]?>
                                <?endif?>
                            <?endif?>
                        <?endif?>
                        <?if(strlen($arParams['TABS_LIST_INCLUDE_' . $code]) > 0):?>
                            <?$APPLICATION->IncludeFile(
                                $arParams['TABS_LIST_INCLUDE_' . $code],
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        <?elseif(strlen($arParams['TABS_LIST_ITEM_' . $code]) > 0 && isset($arResult['PROPERTIES'][$arParams['TABS_LIST_ITEM_' . $code]])):?>
                            <?$property = $arResult['DISPLAY_PROPERTIES'][$arParams['TABS_LIST_ITEM_' . $code]];?>
                            <?if(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "HTML"):?>
                                <?=$property['DISPLAY_VALUE']?>
                            <?elseif(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "TEXT"):?>
                                <p><?=$property['VALUE']["TEXT"]?></p>
                            <?else:?>
                                <?=(
                                is_array($property['VALUE'])
                                    ? implode(' / ', $property['VALUE'])
                                    : $property['VALUE']
                                )?>
                            <?endif;?>
                            <?unset($property);?>
                        <?endif?>
                    <?endif?>
                </div>
                <?endif;?>
            <?endforeach?>
            </div>
        </div>
        <?endif;?>

</div>
</div>

<!-- конец блок с комплектациями -->

<!-- блок отзывов -->

<?//if(!empty($arResult['REVIEW']["ITEMS"])):?>
    <div class="row" style="margin-top: 2em;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="smt-header smt-header-underline-left">Комментарии</h2>
            <?if(!empty($arParams['BUTTON_LIST'])):?>
                <div class="smt-widget smt-widget_margin">
                    <div class="row">
                    <?foreach ($arParams['BUTTON_LIST'] as $code=>$value):?>
                        <?if(strlen($value) > 0 && $arParams['BUTTON_LIST_HREF_' . $code] == '#smt-popup-review' ):?>
                            <div class="col-xs-9 col-sm-5 col-md-4 col-lg-3">
                                <a data-object-id="<?=$arResult["ID"]?>" href="<?=isset($arParams['BUTTON_LIST_HREF_' . $code])?$arParams['BUTTON_LIST_HREF_' . $code]:""?>" class="<?=isset($arParams['BUTTON_LIST_CLASS_' . $code])?$arParams['BUTTON_LIST_CLASS_' . $code]:""?>"><?=htmlspecialcharsbx($value)?></a>
                            </div>
                        <?endif?>
                    <?endforeach?>
                    </div>
                </div>
            <?endif;?>
	        <?foreach($arResult['REVIEW']["ITEMS"] as $item):?>
	<?//var_export($item)?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="row" style="border: 1px solid #30ABE2; border-radius:4px; margin-bottom: 15px;">
                        <div class="col-md-8 element-person">
                            <span class="element-name"><?=$item["NAME"]?></span>
                        </div>
                        <div class=" col-md-4 element-note">
                            <span class="element-date">
                                <?=($item["DATE_ACTIVE_FROM"]? $item["DATE_ACTIVE_FROM"]: $item["DATE_CREATE"])?>
                            </span>
                        </div>
			<div class="col-md-11 element-preview" style="margin: 15px;">
                            <p><?=$item["DETAIL_TEXT"]?></p>
                        </div>
						<? if ( ! empty(trim($item['PREVIEW_TEXT']))){ ?>
                            <div class="col-md-11 pull-right">
<hr>
                                <span>Ответ менеджера: </span>
                                <p><?=$item['PREVIEW_TEXT']?></p>
                            </div>
						<? } ?>
                    </div>
	</div>
<?endforeach;?>
        </div>
    </div>
<?//endif;?>
<!-- конец блока отзывов -->


<?$this->SetViewTarget('smt_footer');?>
<div class="smt-popup mfp-hide" id="smt-popup-order">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_order_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_order.php",
                Array("OBJECT_ID" => $arResult["ID"]),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>
<div class="smt-popup mfp-hide" id="smt-popup-consult">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_consult_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_consult.php",
                Array("OBJECT_ID" => $arResult["ID"]),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>
<div class="smt-popup mfp-hide" id="smt-popup-review">
     <section class="smt-widget smt-widget_no-margin">
          <header>
              <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
					SITE_DIR."smt_include/form_review_header.php",
					Array(),
					Array("MODE"=>"html")
				);?></div>
          </header>
          <div class="smt-widget__content">
			<?$APPLICATION->IncludeFile(
				SITE_DIR."smt_include/form_review.php",
				Array("OBJECT_ID" => $arResult["ID"]),
				Array("MODE"=>"html", "SHOW_BORDER"=>false)
			);?>
           </div>
     </section>
</div>
<?$this->EndViewTarget();?>