<?php
/**
 * @author PC Drew <pc@schoolblocks.com>
 */
use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';
\Tester\Environment::setup();

$cal = new \om\IcalParser();


$results = $cal->parseFile(__DIR__ . '/cal/recurring_monday_events.ics');
$events = $cal->getSortedEvents();

$recurrences = $events[0]['RECURRENCES'];
Assert::equal(10, sizeof($recurrences));

Assert::equal('7.10.2013 10:00:00', $recurrences[0]->format('j.n.Y H:i:s'));
Assert::equal('8.10.2013 10:00:00', $recurrences[1]->format('j.n.Y H:i:s'));
Assert::equal('14.10.2013 10:00:00', $recurrences[2]->format('j.n.Y H:i:s'));
Assert::equal('15.10.2013 10:00:00', $recurrences[3]->format('j.n.Y H:i:s'));
Assert::equal('21.10.2013 10:00:00', $recurrences[4]->format('j.n.Y H:i:s'));
Assert::equal('22.10.2013 10:00:00', $recurrences[5]->format('j.n.Y H:i:s'));
Assert::equal('28.10.2013 10:00:00', $recurrences[6]->format('j.n.Y H:i:s'));
Assert::equal('29.10.2013 10:00:00', $recurrences[7]->format('j.n.Y H:i:s'));
Assert::equal('4.11.2013 10:00:00', $recurrences[8]->format('j.n.Y H:i:s'));
Assert::equal('5.11.2013 10:00:00', $recurrences[9]->format('j.n.Y H:i:s'));
