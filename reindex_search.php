<?
// В качестве аргумента укажите путь к командной строке, например: /home/bitrix/www/
// Использование в crontab: 0 22 * * * bitrix php=$(which php) ; $php -f /home/bitrix/tools/reindex_search.php -- /home/bitrix/www/
// https://dev.1c-bitrix.ru/api_help/search/classes/csearch/reindexall.php


set_time_limit(0);
ignore_user_abort(true);

$_SERVER['DOCUMENT_ROOT'] = $argv[1];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('BX_CRONTAB', true);
define('BX_NO_ACCELERATOR_RESET', true);
//define('SITE_ID', 's1');
//define('LANG', 'ru');

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!CModule::IncludeModule('search')) {
   die('Search module not included');
}

$time_start = time();

$progress = array();
$max_execution_time = 10000; // все элементы индексируются только при большом шаге

while (is_array($progress)) {
   $progress = CSearch::ReIndexAll(true, $max_execution_time, $progress);
}

$total_time = time() - $time_start;

echo 'reindex finished. total time: ' . $total_time . ' seconds, indexed elements: ' . $progress . "\r\n";
