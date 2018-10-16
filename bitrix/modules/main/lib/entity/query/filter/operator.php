<?php
/**
 * Bitrix Framework
 * @package    bitrix
 * @subpackage main
 * @copyright  2001-2016 Bitrix
 */

namespace Bitrix\Main\Entity\Query\Filter;
use Bitrix\Main\Entity\Query\Filter\Expression\NullEx;

/**
 * SQL operators handler.
 * @package    bitrix
 * @subpackage main
 */
class Operator
{
	/**
	 * Available operators.
	 * @var array
	 */
	protected static $operators = array(
		'=' => 'eq',
		'<>' => 'neq',
		'!=' => 'neq',
		'<' => 'lt',
		'<=' => 'lte',
		'>' => 'gt',
		'>=' => 'gte',
		'in' => 'in',
		'between' => 'between',
		'like' => 'like',
		'exists' => 'exists'
	);

	/**
	 * List of available operators `code => method`.
	 *
	 * @return array
	 */
	public static function get()
	{
		return static::$operators;
	}

	public static function eq($columnSql, $valueSql)
	{
		if ($valueSql instanceof NullEx)
		{
			return "{$columnSql} IS NULL";
		}
		return "{$columnSql} = {$valueSql}";
	}

	public static function neq($columnSql, $valueSql)
	{
		if ($valueSql instanceof NullEx)
		{
			return "{$columnSql} IS NOT NULL";
		}
		return "{$columnSql} <> {$valueSql}";
	}

	public static function lt($columnSql, $valueSql)
	{
		return "{$columnSql} < {$valueSql}";
	}

	public static function lte($columnSql, $valueSql)
	{
		return "{$columnSql} <= {$valueSql}";
	}

	public static function gt($columnSql, $valueSql)
	{
		return "{$columnSql} > {$valueSql}";
	}

	public static function gte($columnSql, $valueSql)
	{
		return "{$columnSql} >= {$valueSql}";
	}

	public static function in($columnSql, $valueSql)
	{
		return "{$columnSql} IN (".join(', ', (array) $valueSql).")";
	}

	public static function between($columnSql, $valueSql)
	{
		return "{$columnSql} BETWEEN {$valueSql[0]} AND {$valueSql[1]}";
	}

	public static function like($columnSql, $valueSql)
	{
		return "{$columnSql} LIKE {$valueSql}";
	}

	public static function exists($columnSql, $valueSql)
	{
		return "EXISTS ({$valueSql})";
	}
}
