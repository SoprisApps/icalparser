<?php
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';
\Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

// sort by date
$cal = new \om\IcalParser();
$results = $cal->parseFile(__DIR__ . '/cal/basic.ics');
$events = $cal->getSortedEvents();
Assert::same('1.1.2013 00:00:00', $events[0]['DTSTART']->format('j.n.Y H:i:s'));

// reverse sort (parseFile)
$cal = new \om\IcalParser();
$results = $cal->parseFile(__DIR__ . '/cal/basic.ics');
$events = $cal->getReverseSortedEvents();
Assert::same('26.12.2015 00:00:00', $events[0]['DTSTART']->format('j.n.Y H:i:s'));

// reverse sort (parseString)
$cal = new \om\IcalParser();
$results = $cal->parseString(file_get_contents(__DIR__ . '/cal/basic.ics'));
$events = $cal->getReverseSortedEvents();
Assert::same('26.12.2015 00:00:00', $events[0]['DTSTART']->format('j.n.Y H:i:s'));