<?php

namespace SanikeevModule\Event;

use SanikeevModule\Sql\TestTable;
/**
 * Description of cMainEvent
 *
 * @author Сергей
 */
class cMainEvent {

	public function OnPageStartHandler() {
		TestTable::add(array(
			'URL' => $_SERVER['REQUEST_URI'],
		));
	}
}
