<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<ul class="smt-breadcrumb">';

$itemSize = count($arResult);

for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index == 0) {
		$strReturn .= '
		<li class="smt-breadcrumb__item" id="bx_breadcrumb_'.$index.'" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"'.$child.$nextRef.'>
			<a class="smt-breadcrumb__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url"><span class="fa fa-home"></span></a>
		</li>';
	}
	elseif($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
		<li class="smt-breadcrumb__item" id="bx_breadcrumb_'.$index.'" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"'.$child.$nextRef.'>
			<a class="smt-breadcrumb__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url"><span itemprop="title">'.$title.'</span></a>
		</li>';
	}
	else
	{
		$strReturn .= '
		<li class="smt-breadcrumb__item" id="bx_breadcrumb_'.$index.'" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"'.$child.$nextRef.'>
			<a class="smt-breadcrumb__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url"><span itemprop="title">'.$title.'</span></a>
		</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;