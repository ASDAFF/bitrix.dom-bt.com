<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2012 Bitrix
 */

namespace Bitrix\Main\Mail;

use Bitrix\Main\Config as Config;
use Bitrix\Main\Application;
use Bitrix\Main\EventResult;
use Bitrix\Main\Security\Sign\BadSignatureException;
use Bitrix\Main\Security\Sign\Signer;

class Tracking
{
	const SIGN_SALT_ACTION = 'event_mail_tracking';

	/**
	 * @param $moduleId
	 * @param $arFields
	 * @return string
	 */
	public static function getTag($moduleId, $arFields)
	{
		return $moduleId.".".base64_encode(json_encode($arFields));
	}

	/**
	 * @param $tag
	 * @return array
	 */
	public static function parseTag($tag)
	{
		$arTag = explode(".", $tag);
		$moduleId = $arTag[0];
		unset($arTag[0]);
		return array('MODULE_ID' => $moduleId, 'FIELDS' => (array) json_decode(base64_decode(implode('.', $arTag))));
	}

	/**
	 * @param $moduleId
	 * @param $arFields
	 * @return string
	 * @throws \Bitrix\Main\ArgumentTypeException
	 */
	public static function getSignedTag($moduleId, $arFields)
	{
		$tag = static::getTag($moduleId, $arFields);
		$signer = new Signer;
		return $signer->sign($tag, static::SIGN_SALT_ACTION);
	}

	/**
	 * @param $signedTag
	 * @return array
	 * @throws \Bitrix\Main\Security\Sign\BadSignatureException
	 */
	public static function parseSignedTag($signedTag)
	{
		$signer = new Signer;
		$unsignedTag = $signer->unsign($signedTag, static::SIGN_SALT_ACTION);
		return static::parseTag($unsignedTag);
	}

	/**
	 * @param $moduleId
	 * @param $arFields
	 * @return string
	 */
	public static function getLinkRead($moduleId, $arFields)
	{
		$tag = static::getTag($moduleId, $arFields);
		$bitrixDirectory = \Bitrix\Main\Application::getInstance()->getPersonalRoot();
		return $bitrixDirectory.'/tools/track_mail_read.php?tag='.urlencode($tag);
	}

	/**
	 * Get click link.
	 *
	 * @param string $moduleId Module ID.
	 * @param array $fields Fields.
	 * @return string
	 */
	public static function getLinkClick($moduleId, $fields)
	{
		$uri = Application::getInstance()->getPersonalRoot();
		$uri .= '/tools/track_mail_click.php';
		$uri .= '?tag=' . urlencode(static::getTag($moduleId, $fields));

		return $uri;
	}

	/**
	 * @param $moduleId
	 * @param $arFields
	 * @return string
	 */
	public static function getLinkUnsub($moduleId, $arFields, $urlPage = "")
	{
		$tag = static::getSignedTag($moduleId, $arFields);
		if($urlPage == "")
		{
			$bitrixDirectory = \Bitrix\Main\Application::getInstance()->getPersonalRoot();
			$resutl = $bitrixDirectory.'/tools/track_mail_unsub.php?tag='.urlencode($tag);
		}
		else
		{
			$resutl = $urlPage.(strpos($urlPage, "?")===false ? "?" : "&").'tag='.urlencode($tag);
		}

		return $resutl;
	}

	/**
	 * Get sign.
	 *
	 * @param string $value Value.
	 * @return string
	 */
	public static function getSign($value)
	{
		static $cached = array();
		foreach ($cached as $cache)
		{
			if ($cache[0] == $value)
			{
				return $cache[1];
			}
		}

		$signer = new Signer;
		$sign = $signer->getSignature($value, static::SIGN_SALT_ACTION);

		$cached[] = array($value, $sign);
		if (count($cached) > 10)
		{
			array_shift($cached);
		}

		return $sign;
	}

	/**
	 * Verify sign.
	 *
	 * @param string $value Value.
	 * @param string $signature Signature.
	 * @return bool
	 */
	public static function validateSign($value, $signature)
	{
		try
		{
			$signer = new Signer;
			return $signer->validate($value, $signature, static::SIGN_SALT_ACTION);
		}
		catch (BadSignatureException $exception)
		{
			return false;
		}
	}

	/**
	 * @param $arData
	 * @return array|bool
	 */
	public static function getSubscriptionList($arData)
	{
		$arSubscription = array();

		if(array_key_exists('MODULE_ID', $arData))
			$filter = array($arData['MODULE_ID']);
		else
			$filter = null;

		if(!is_array($arData['FIELDS'])) return false;

		$event = new \Bitrix\Main\Event("main", "OnMailEventSubscriptionList", array($arData['FIELDS']), $filter);
		$event->send();
		foreach ($event->getResults() as $eventResult)
		{
			if ($eventResult->getType() == EventResult::ERROR)
			{
				return false;
			}

			$subscriptionList = $eventResult->getParameters();
			if($subscriptionList && is_array($subscriptionList['LIST']))
			{
				$arSubscription = array_merge(
					$arSubscription,
					array($eventResult->getModuleId() => $subscriptionList['LIST'])
				);
			}
		}

		if(array_key_exists('MODULE_ID', $arData))
			$arSubscription = $arSubscription[$arData['MODULE_ID']];

		return $arSubscription;
	}

	/**
	 * @param $arData
	 * @return bool
	 */
	public static function subscribe($arData)
	{
		if(!is_array($arData['FIELDS'])) return false;

		$event = new \Bitrix\Main\Event("main", "OnMailEventSubscriptionEnable", array($arData['FIELDS']), array($arData['MODULE_ID']));
		$event->send();
		foreach ($event->getResults() as $eventResult)
		{
			if ($eventResult->getType() == EventResult::ERROR)
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * @param $arData
	 * @return bool
	 */
	public static function unsubscribe($arData)
	{
		if(!is_array($arData['FIELDS'])) return false;

		$event = new \Bitrix\Main\Event("main", "OnMailEventSubscriptionDisable", array($arData['FIELDS']), array($arData['MODULE_ID']));
		$event->send();
		foreach ($event->getResults() as $eventResult)
		{
			if ($eventResult->getType() == EventResult::ERROR)
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * @param array $arData
	 * @return bool
	 */
	public static function click(array $arData)
	{
		if(array_key_exists('MODULE_ID', $arData))
			$filter = array($arData['MODULE_ID']);
		else
			$filter = null;

		$event = new \Bitrix\Main\Event("main", "OnMailEventMailClick", array($arData['FIELDS']), $filter);
		$event->send();
		foreach ($event->getResults() as $eventResult)
		{
			if ($eventResult->getType() == \Bitrix\Main\EventResult::ERROR)
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * @param array $arData
	 * @return bool
	 */
	public static function read(array $arData)
	{
		if(array_key_exists('MODULE_ID', $arData))
			$filter = array($arData['MODULE_ID']);
		else
			$filter = null;

		$event = new \Bitrix\Main\Event("main", "OnMailEventMailRead", array($arData['FIELDS']), $filter);
		$event->send();
		foreach ($event->getResults() as $eventResult)
		{
			if ($eventResult->getType() == \Bitrix\Main\EventResult::ERROR)
			{
				return false;
			}
		}

		return true;
	}
}
