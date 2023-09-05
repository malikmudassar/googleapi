<?php
require __DIR__ . '/vendor/autoload.php';
$data = file_get_contents("php://input");
$events = json_decode($data, true);

//delete previous event


// Load the Google Client and set up credentials (similar to your existing code)
$client = new Google_Client();
$client->setApplicationName('Google Calendar API PHP Quickstart');
$client->setScopes(array(Google_Service_Calendar::CALENDAR));
$client->setAuthConfig('credential.json');
$client->setAccessType('offline');
$client->getAccessToken();
$client->getRefreshToken();

// Create a new Google Calendar service instance
$service = new Google_Service_Calendar($client);

// Set the event ID of the event you want to delete
$eventId = $events['eventId'];

// Delete the event from the calendar
try {
    $service->events->delete('info@chandnihalls.com', $eventId);
    //echo "Event deleted successfully.";
} catch (Google_Service_Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}



//add new event 



//2022-10-01T09:00:00-04:00  2022-09-21 2022-10-31 19:00
//$datetime = $events['datetime'].':00-04:00';
//$datetime = str_replace(" ","T",$datetime);

$eventStartTime='T08:00:00-04:00';
$eventEndTime='T09:00:00-04:00';
$startdate=$events['datetime'];
$enddate=$events['datetime'];

if($events['eventTime']=='Morning Event'){ 
    $eventStartTime='T08:00:00-04:00';
    $eventEndTime='T15:00:00-04:00';
}

if($events['eventTime']=='Evening Event'){ 
    $eventStartTime='T18:00:00-04:00';
    $eventEndTime='T01:00:00-04:00';
    $enddate= date("Y-m-d", strtotime($events['datetime']) + 86400);
    
}

if($events['eventTime']=='Full Day Event'){ 
    $eventStartTime='T08:00:00-04:00';
    $eventEndTime='T01:00:00-04:00';
    $enddate= date("Y-m-d", strtotime($events['datetime']) + 86400);
}


$datetime = $startdate.$eventStartTime;

$enddatetime = $enddate.$eventEndTime;

$hallname='';
if($events['hallid']==1){ $hallname='Chandni Chrysler';}
if($events['hallid']==2){ $hallname='Chandni Gateway';}
if($events['hallid']==3){ $hallname='Chandni Convention';}
if($events['hallid']==4){ $hallname='Chandni Country Club';}
if($events['hallid']==5){ $hallname='Chandni Victoria';}

$clientName=$events['clientName'];




$fp2 = fopen('eventdata.txt', 'a');
fwrite($fp2, $data);
fclose($fp2);

require __DIR__ . '/vendor/autoload.php';


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

echo $event->id;


