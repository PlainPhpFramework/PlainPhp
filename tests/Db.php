<?php

require __dir__.'/../src/Db.php';


function ttest($msg, $assertion) {
	echo $msg, "\n";

	if (!$assertion) {
		throw new Exception("Test fail!", 1);
	}
}


$db = new PlainPhp\Pdo\Db('sqlite::memory:');

ttest('$db is an instance of PDO', $db instanceof \Pdo);
ttest('$db is an instance of PDO', $db->query('select 1') instanceof \PDOStatement);