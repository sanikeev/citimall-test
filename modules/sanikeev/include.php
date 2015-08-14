<?php

CModule::AddAutoloadClasses(
	"sanikeev", array(
	"SanikeevModule\\Event\\cMainEvent" => "lib/event/cMainEvent.php",
	"SanikeevModule\\Sql\\TestTable" => "lib/sql/Test.php",
	)
);
?>