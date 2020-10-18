<?php
namespace PlainPhp;

class DbDebug extends Statement
{
	function execute($parameters = null) 
	{
		$execute_start = microtime(true);
		$return = parent::execute($parameters);
		$execution_time = microtime(true)-$execute_start;

		if (!isset($_ENV['debug']['PDO']['total_execution_time'])) {
			$_ENV['debug']['PDO']['total_execution_time'] = 0;
			$_ENV['debug']['PDO']['total_queries'] = 0;
		}

		ob_start();
		$this->debugDumpParams();
		$_ENV['debug']['PDO'][] = [
			'dump' => ob_get_contents(),
			'execution_time' => $execution_time
		];
		ob_end_clean();

		++$_ENV['debug']['PDO']['total_queries'];
		$_ENV['debug']['PDO']['total_execution_time'] += $execution_time;

		return $return;

	}	
}