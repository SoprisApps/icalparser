<?php
/**
 * @author PC Drew <pc@schoolblocks.com>
 */
use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';
\Tester\Environment::setup();

$cal = new \om\IcalParser();

// The below ICS file has a great edge case example: one event, no recurrences in the
// recurring ruleset, and a modification to the initial event.
$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_with_modifications_to_first_day.ics');
$events = $cal->getSortedEvents(true);
Assert::true(empty($events[0]['RECURRENCES'])); // edited event
Assert::true(empty($events[1]['RECURRENCES'])); // recurring event base with no recurrences
Assert::equal(1, count($events));


// In this ICS file, there's an original recurring event with 1 occurance (itself) it is also excluded
// due to an EXDATE.  Then there's another recurring event with 2 occurances (itself and one other) and
// the first event was modified.
$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_with_modifications_excluding_first_day.ics');
$events = $cal->getSortedEvents(true);

Assert::equal(2, sizeof($events));

$editedFirstEvent = $events[0];
Assert::true(empty($editedFirstEvent['RECURRENCES']));
Assert::equal('6.10.2020 19:00:00', $editedFirstEvent['DTSTART']->format('j.n.Y H:i:s'));

$recurranceEvent = $events[1];
Assert::true(empty($recurranceEvent['RECURRENCES']));
Assert::equal('1.12.2020 18:30:00', $recurranceEvent['DTSTART']->format('j.n.Y H:i:s'));
