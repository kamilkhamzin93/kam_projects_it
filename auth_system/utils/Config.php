<?php
	
	define("DB_NAME", "it_projects_db");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_HOST", "localhost");
	
	@mysql_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	@mysql_select_db(DB_NAME);
	@mysql_query("SET NAMES cp1251");
	
	define ("SITE_TITLE", "IT PROJECTS");
	
	
?>