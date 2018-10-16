<?
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("NOT_CHECK_PERMISSIONS", true);
define("DisableEventsCheck", true);
define("NO_AGENT_CHECK", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;
use Bitrix\Main\Mail\Tracking;

$request = Context::getCurrent()->getRequest();
$url = $request->get('url');
$sign = $request->get('sign');
$tag = $request->get('tag');

$tag = Tracking::parseTag($tag);
$tag['FIELDS']['IP'] = $request->getRemoteAddress();
$tag['FIELDS']['URL'] = $url;
Tracking::click($tag);

$skipSecCheck = ($sign && $url && Tracking::validateSign($url, $sign));
if ($url)
{
	LocalRedirect($url, $skipSecCheck);
}
else
{
	LocalRedirect('/');
}