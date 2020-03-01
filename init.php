<?
$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('sale', 'registerInputTypes', 'registerInputTypePaySystemLocations');
?>
