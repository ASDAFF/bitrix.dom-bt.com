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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'smt-widget smt-widget_section-list',
		'TITLE' => 'h4 smt-header smt-header-underline-left',
		'LIST' => 'smt-list smt-list_arrow',
	),
	'LINE' => array(
		'CONT' => 'smt-widget smt-widget_section-list',
		'TITLE' => 'h4 smt-header smt-header-underline-left',
		'LIST' => '',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'smt-widget smt-widget_section-list',
		'TITLE' => 'h4 smt-header smt-header-underline-left',
		'LIST' => 'list-inline'
	),
	'TILE' => array(
		'CONT' => 'smt-widget smt-widget_section-list',
		'TITLE' => 'h4 smt-header smt-header-underline-left',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h2
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h2><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<?switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':?>
			<?foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'] || null === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?>
				<div class="smt-blog-item smt-blog-item_line" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<div class="row">
						<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][0])?>">
							<a class="smt-image smt-image_hover" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
								<?if($arSection['PREVIEW_PICTURE']['SRC'] || $arSection['PICTURE']['SRC']):?>
								<img src="<? echo ($arSection['PREVIEW_PICTURE']['SRC'])?$arSection['PREVIEW_PICTURE']['SRC']:$arSection['PICTURE']['SRC']; ?>" class="smt-image__image smt-img-thumbnail" alt="<?=$arSection['PICTURE']['ALT']?>">
								<span class="smt-image__over"></span>
								<?endif?>
							</a>
						</div>
						<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][1])?>">
							<div class="smt-blog-item__name">
								<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="smt-blog-item__link"><? echo $arSection['NAME']; ?><?
									if ($arParams["COUNT_ELEMENTS"])
									{
										?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
									}
									?></a>
							</div>
							<?if($arParams['DISPLAY_PREVIEW_TEXT'] == 'Y'):?>
								<div class="smt-blog-item__text">
									<?
									if(strlen($arSection['UF_PREVIEW_TEXT']) > 0) {
										?><? echo $arSection['UF_PREVIEW_TEXT']; ?><?
									}
									?>
								</div>
							<?endif?>
							<?if($arParams['DISPLAY_DESCRIPTION'] == 'Y'):?>
								<div class="smt-blog-item__text">
									<?
									if ('' != $arSection['DESCRIPTION']) {
										?>
										<?if($arSection["DESCRIPTION_TYPE"] == 'text'):?>
											<p><? echo $arSection['DESCRIPTION']; ?></p>
										<?else:?>
											<? echo $arSection['DESCRIPTION']; ?>
										<?endif?>
										<?
									}
									?>
								</div>
							<?endif?>
							<?if($arParams['DISPLAY_BUTTON'] == 'Y'):?>
								<div class="smt-blog-item__button">
									<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="btn smt-btn smt-btn-sm"><?=GetMessage("SMT_BCSL_BUTTON_LIST")?></a>
								</div>
							<?endif?>
						</div>
					</div>
				</div>
			<? }
			unset($arSection);?>
			<?break;
		case 'TEXT':?>
			<ul class="<? echo $arCurView['LIST']; ?>">
			<?foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></a></li><?
			}
			unset($arSection);?>
			</ul>
			<?break;
		case 'TILE':?>
			<? $count = 0; ?>
			<? if(!$arParams["LINE_ELEMENT_COUNT"]) $arParams["LINE_ELEMENT_COUNT"] = 2; ?>
			<? $lineCount = $arParams["LINE_ELEMENT_COUNT"]; ?>
			<? $rowLineCount = 12/$arParams["LINE_ELEMENT_COUNT"]; ?>
			<div class="row smt-auto-clear">
			<?foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'] || null === $arSection['PICTURE']) {
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
						'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
						'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				}
				?>
				<div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>">
					<div class="smt-blog-item smt-blog-item_line" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
						<div class="row">
							<?if($arParams['DISPLAY_PICTURE'] == 'Y'):?>
								<?if($arParams['DISPLAY_NAME'] == 'Y' || $arParams['DISPLAY_PREVIEW_TEXT'] == 'Y' || $arParams['DISPLAY_DESCRIPTION'] == 'Y' || $arParams['DISPLAY_BUTTON'] == 'Y'):?>
								<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][0])?>">
								<?else:?>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<?endif?>
									<a class="smt-image smt-gallery-image smt-image-inline-block smt-image_hover" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
										<?if($arSection['PREVIEW_PICTURE']['SRC'] || $arSection['PICTURE']['SRC']):?>
										<img src="<? echo ($arSection['PREVIEW_PICTURE']['SRC'])?$arSection['PREVIEW_PICTURE']['SRC']:$arSection['PICTURE']['SRC']; ?>" class="smt-image__image smt-img-thumbnail smt-image-inline-block" alt="<?=$arSection['PICTURE']['ALT']?>">
										<?endif?>
										<span class="smt-image__over"></span>
										<?if($arParams["DISPLAY_IMAGE_NAME"] == "Y" || $arParams["DISPLAY_IMAGE_PREVIEW_TEXT"] == "Y"):?>
										<span class="smt-image__over-text">
											<span class="smt-gallery-image__content">
											<?if($arParams["DISPLAY_IMAGE_NAME"] == "Y"):?>
												<span class="smt-gallery-image__name"><?=$arSection['NAME']?></span>
											<?endif?>
												<?if($arParams["DISPLAY_IMAGE_PREVIEW_TEXT"] == "Y"):?>
													<span class="smt-gallery-image__descr">
														<?
														if(strlen($arSection['UF_PREVIEW_TEXT']) > 0) {
															?><? echo $arSection['UF_PREVIEW_TEXT']; ?><?
														}
														?>
													</span>
												<?endif?>
											</span>
										</span>
										<?endif?>
									</a>
								</div>
							<?endif?>
							<?if($arParams['DISPLAY_NAME'] == 'Y' || $arParams['DISPLAY_PREVIEW_TEXT'] == 'Y' || $arParams['DISPLAY_DESCRIPTION'] == 'Y' || $arParams['DISPLAY_BUTTON'] == 'Y'):?>
								<?if($arParams['DISPLAY_PICTURE'] == 'Y'):?>
								<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][1])?>">
								<?else:?>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<?endif?>
									<?if($arParams['DISPLAY_NAME'] == 'Y'):?>
									<div class="smt-blog-item__name">
										<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="smt-blog-item__link"><?if ('Y' != $arParams['HIDE_SECTION_NAME']) {
											echo $arSection['NAME']; ?><?
											if ($arParams["COUNT_ELEMENTS"])
											{
												?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
											}
										} ?></a>
									</div>
									<?endif?>
									<?if($arParams['DISPLAY_PREVIEW_TEXT'] == 'Y'):?>
									<div class="smt-blog-item__text">
										<?
										if(strlen($arSection['UF_PREVIEW_TEXT']) > 0) {
											?><? echo $arSection['UF_PREVIEW_TEXT']; ?><?
										}
										?>
									</div>
									<?endif?>
									<?if($arParams['DISPLAY_DESCRIPTION'] == 'Y'):?>
										<div class="smt-blog-item__text">
											<?
											if ('' != $arSection['DESCRIPTION']) {
												?><? echo $arSection['DESCRIPTION']; ?><?
											}
											?>
										</div>
									<?endif?>
									<?if($arParams['DISPLAY_BUTTON'] == 'Y'):?>
										<div class="smt-blog-item__button">
											<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="btn smt-btn smt-btn-sm"><?=GetMessage("SMT_BCSL_BUTTON_LIST")?></a>
										</div>
									<?endif?>
								</div>
							<?endif?>
						</div>
					</div>
				</div><?
			}
			unset($arSection);?>
			</div>
			<?break;?>
		<?case 'LIST':?>
			<ul class="<? echo $arCurView['LIST']; ?>">
			<?
			$intCurrentDepth = 1;
			$boolFirst = true;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (0 < $intCurrentDepth)
						echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
				}
				elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (!$boolFirst)
						echo '</li>';
				}
				else
				{
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
						$intCurrentDepth--;
					}
					echo str_repeat("\t", $intCurrentDepth-1),'</li>';
				}

				echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
				?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><span class="h5 smt-header smt-header-underline-left"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a></span><?
				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1)
			{
				echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '</li>',"\n";
			}?>
			</ul>
			<?break;?>
<?
	}
?>
<?
}
?>






</div>
