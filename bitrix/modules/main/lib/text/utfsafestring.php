<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2016 Bitrix
 */
namespace Bitrix\Main\Text;

class UtfSafeString
{
	public static function getLastPosition($haystack, $needle)
	{
		if (defined("BX_UTF"))
		{
			//mb_strrpos does not work on invalid UTF-8 strings
			$ln = strlen($needle);
			for ($i = strlen($haystack) - $ln; $i >= 0; $i--)
			{
				if (substr($haystack, $i, $ln) == $needle)
				{
					return $i;
				}
			}
			return false;
		}

		return strrpos($haystack, $needle);
	}

	public static function rtrimInvalidUtf($string)
	{
		//valid UTF-8 octet sequences
		//0xxxxxxx
		//110xxxxx 10xxxxxx
		//1110xxxx 10xxxxxx 10xxxxxx
		//11110xxx 10xxxxxx 10xxxxxx 10xxxxxx

		$last4bytes = \CUtil::binsubstr($string, -3);
		$reversed = array_reverse(unpack("C*", $last4bytes));
		if (($reversed[0] & 0x80) === 0x00) //ASCII
			return $string;
		elseif (($reversed[0] & 0xC0) === 0xC0) //Start of utf seq (cut it!)
			return \CUtil::binsubstr($string, 0, -1);
		elseif (($reversed[1] & 0xE0) === 0xE0) //Start of utf seq (longer than 2 bytes)
			return \CUtil::binsubstr($string, 0, -2);
		elseif (($reversed[2] & 0xE0) === 0xF0) //Start of utf seq (longer than 3 bytes)
			return \CUtil::binsubstr($string, 0, -3);
		return $string;
	}
}