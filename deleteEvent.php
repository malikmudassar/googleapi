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






