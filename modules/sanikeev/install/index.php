<?php

Class sanikeev extends CModule {

	var $MODULE_ID = "sanikeev";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;

	function sanikeev() {
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path . "/version.php");

		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

		$this->MODULE_NAME = "SANIKEEV MODULE - модуль тестового задания";
		$this->MODULE_DESCRIPTION = "Сохраняет все адреса запршенных страниц в таблицу SANIKEEV_TEST по событию OnPageStart";
	}

	public function InstallDb() {
		global $DB, $DBType, $APPLICATION;
		$this->errors = false;

		// Database tables creation
		if (!$DB->Query("SELECT 1 FROM SANIKEEV_TEST WHERE 1=0", true)) {
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"] . "/local/modules/sanikeev/install/db/install.sql");
		}

		if ($this->errors !== false) {
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}
		RegisterModuleDependences("main", "OnPageStart", "sanikeev", "SanikeevModule\Event\cMainEvent", "OnPageStartHandler");

		return true;
	}

	public function UnInstallDB() {
		global $DB, $DBType, $APPLICATION;
		$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"] . "/local/modules/sanikeev/install/db/uninstall.sql");
		if ($this->errors !== false) {
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}

		UnRegisterModuleDependences("main", "OnPageStart", "sanikeev", "SanikeevModule\Event\cMainEvent", "OnPageStartHandler");
		return true;
	}

	function DoInstall() {
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->InstallDb();
		RegisterModule("sanikeev");
		$APPLICATION->IncludeAdminFile("Установка модуля sanikeev_module", $DOCUMENT_ROOT . "/local/modules/sanikeev/install/step.php");
	}

	function DoUninstall() {
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->UnInstallDB();
		UnRegisterModule("sanikeev");
		$APPLICATION->IncludeAdminFile("Деинсталляция модуля sanikeev_module", $DOCUMENT_ROOT . "/local/modules/sanikeev/install/unstep.php");
	}

}
