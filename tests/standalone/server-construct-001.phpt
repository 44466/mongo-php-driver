--TEST--
MongoDB\Driver\Server::__construct()
--SKIPIF--
<?php require "tests/utils/basic-skipif.inc"; CLEANUP(STANDALONE) ?>
--FILE--
<?php
require_once "tests/utils/basic.inc";

$parsed = parse_url(STANDALONE);
$manager = new MongoDB\Driver\Manager(STANDALONE);
$server = $manager->executeInsert(NS, array("foo" => "bar"))->getServer();

var_dump($server->getHost() == $parsed["host"]);
var_dump($server->getPort() == $parsed["port"]);
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
bool(true)
bool(true)
===DONE===
