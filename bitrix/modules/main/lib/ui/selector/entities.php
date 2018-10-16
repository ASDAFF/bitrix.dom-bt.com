<?

namespace Bitrix\Main\UI\Selector;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class Entities
{
	public static function getList($params = array())
	{
		$result = array();

		if (empty($params['context']))
		{
			return $result;
		}

		if (empty($params['itemsSelected']))
		{
			return $result;
		}

		$event = new Event("main", "OnUISelectorEntitiesGetList", $params);
		$event->send();
		$eventResultList = $event->getResults();

		if (is_array($eventResultList) && !empty($eventResultList))
		{
			foreach ($eventResultList as $eventResult)
			{
				if ($eventResult->getType() == EventResult::SUCCESS)
				{
					$resultParams = $eventResult->getParameters();
					$result = $resultParams['result'];
					break;
				}
			}
		}

		return $result;
	}
}