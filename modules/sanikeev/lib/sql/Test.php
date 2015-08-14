<?php

namespace SanikeevModule\Sql;

use Bitrix\Main\Entity\DataManager;

/**
 * Description of Test
 *
 * @author Сергей
 */
class TestTable extends DataManager {

	public static function getFilePath() {
		return __FILE__;
	}

	public static function getTableName() {
		return 'SANIKEEV_TEST';
	}

	public static function getMap() {
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
			),
			'URL' => array(
				'data_type' => 'string',
				'required' => true,
			),
			'REQUEST_AT' => array(
				'data_type' => 'date_time',
			),
		);
	}

}
