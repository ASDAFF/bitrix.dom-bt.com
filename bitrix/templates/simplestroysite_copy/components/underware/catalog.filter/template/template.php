<? if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){
    die();
}
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
<div class="bx-filter <?=$templateData["TEMPLATE_CLASS"]?> bx-filter-horizontal">
    <div id="rg_filter_height" class="bx-filter-section">
        <div class="row">
            <div class="col-lg-12 bx-filter-title">
                <span class="smt-header-center" style="font-weight: bold;">ПОПУЛЯРНЫЕ КАТЕГОРИИ:</span>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 tags-cloud">
                <? $i = 0;
                foreach ($arResult['ITEMS'] as $links){
                    $i ++;
                    if ($links['PROPERTY_TYPE'] == 'S' ||
                        $links['PROPERTY_TYPE'] == 'N'
                    ){/*?>
							<span class="link <? if ($i >= $arParams["NUMBER_WIDTH"]){
									echo 'hidden';
								} ?>"><?=$links['NAME']?></span>
							<?*/foreach ($links['VALUE'] as $link){
                        $i ++; ?>
                        <a class="link <? if ($i > $arParams["NUMBER_WIDTH"]){
                            echo 'hidden';
                        } ?>"
                           href="<?=$APPLICATION->GetCurPageParam(http_build_query(
                               array (
                                   'prop'  => 'PROPERTY_' . $links['ID'] . '_VALUE',
                                   'value' => $link
                               )
                           ), array ('prop', 'value'))?>">
                            <?=' ' . $link . ' '?>
                        </a>
                    <? }
                    }
                    if ($links['PROPERTY_TYPE'] == 'L'){							/*?>
                            <span class="link <? if ($i > $arParams["NUMBER_WIDTH"]){echo 'hidden';} ?>">
                            <?=$links['NAME']?></span>
                            <?*/unset($links['PROPERTY_TYPE'], $links['SORT'], $links['NAME']);
                        $rg = 0;
                        foreach ($links as $link){
                            $i ++;
                            $rg ++; ?>
                            <a class="link <? if ($i >= $arParams["NUMBER_WIDTH"]){
                                echo 'hidden';
                            } ?>"
                               href="<?=$APPLICATION->GetCurPageParam(http_build_query(
                                   array (
                                       'prop'  => '=PROPERTY_' . $link['PROPERTY_ID'],
                                       'value' => $link['ID']
                                   )
                               ), array ('prop', 'value'))?>">
                                <?=$link['VALUE']?>
                            </a>
                            <?
                        }
                    }
                } ?>
            </div>
        </div>
    </div>
    <? if($rg > $arParams["NUMBER_WIDTH"]) { ?>
        <div id="sl" class="closed">Показать все</div>
    <? } ?>
    <script>
        $(document).ready(function () {
            $links = $('.link');
            $slbutton = $('#sl');
            $links.on('click', function (e) {
                if ($links.length < <?=$arParams["NUMBER_WIDTH"]?>) {
                    $slbutton.addClass('hidden');
                }
                var filter_height = $('#rg_filter_height').height() - 85;
                var destination = $('#rg_filter_scroll').offset().top;
                $('html').animate({scrollTop: destination - filter_height - 62}, 1100);
                return false;
            });
            $slbutton.on('click', function (e) {
                $('.link.hidden').removeClass('hidden');
                if (!$(this).hasClass('closed')) {
                    $(this).html('Показать все').addClass('closed');
                    $('.link').each(function (i, elem) {
                        if (i > <?=$arParams["NUMBER_WIDTH"]?>)
                            $(this).addClass('hidden');
                    })
                }
                else {
                    $(this).html('Свернуть').removeClass('closed');
                }
            })
        });
    </script>
</div>