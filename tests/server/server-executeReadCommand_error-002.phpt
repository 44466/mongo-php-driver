--TEST--
MongoDB\Driver\Server::executeReadCommand() with unknown options
--XFAIL--
Depends on PHPC-1066
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php NEEDS('STANDALONE'); CLEANUP(STANDALONE); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = new MongoDB\Driver\Manager(STANDALONE);
$server = $manager->selectServer(new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_SECONDARY));

$command = new MongoDB\Driver\Command(['ping' => 1]);

echo throws(function() use ($server, $command) {
    $server->executeReadCommand(DATABASE_NAME, $command, ['writeConcern' => 'foo']);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";

echo throws(function() use ($server, $command) {
    $server->executeReadCommand(DATABASE_NAME, $command, ['unknown' => 'foo']);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Unknown option 'writeConcern'
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Unknown option 'unknown'
===DONE===
