<?php
require __DIR__ . '/vendor/autoload.php';
$clientName='digilynx';
$hallname = 'test';
$datetime = '2022-10-20T09:00:00-04:00';
$enddatetime = '2022-10-20T10:00:00-04:00';


    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(array(Google_Service_Calendar::CALENDAR));
    $client->setAuthConfig('credential.json');
    $client->setAccessType('offline');
    $client->getAccessToken();
    $client->getRefreshToken();

  $service = new Google_Service_Calendar($client);

   $event = new Google_Service_Calendar_Event(array(
    	  'summary' => $clientName.' - '.$hallname,
    	  'location' => '2935 Drew Rd, Mississauga, ON L4T 0A1',
    	  'description' => $hallname.' is booked for '.$clientName,
    	  'start' => array(
    	    'dateTime' => $datetime,
    	    'timeZone' => 'Canada/Eastern',
    	  ),
    	  'end' => array(
    	    'dateTime' => $enddatetime,
    	    'timeZone' => 'Canada/Eastern',
    	  ),
    	  'recurrence' => array(
    	    'RRULE:FREQ=DAILY;COUNT=1'
    	  )
	  )
	);

   //$event=(array) $event;

$calendarId = 'info@chandnihalls.com';
$event = $service->events->insert($calendarId, $event);
//var_dump('Event created: %s\n', $event->htmlLink);

$str= $event->htmlLink;
print_r($event);
$str_pos=strpos($str,"=");
$eid=substr($str,$str_pos+1);








