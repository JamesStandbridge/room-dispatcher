<?php

require 'vendor/autoload.php';
use App\Entity\Room;



$rooms_file = file_get_contents(__DIR__."/data/rooms.json");
$schema_file = file_get_contents(__DIR__."/data/room_schemas.json");

$rooms = json_decode($rooms_file, true)["rooms"];
$schemas = json_decode($schema_file, true)["schemas"];

$member_file = file_get_contents(__DIR__."/data/members.json");
$members = json_decode($member_file, true)["members"];

$lodging = [];

foreach($rooms as $room => $number) {
	for($i = 0; $i < $number; $i++) 
		$lodging[] = new Room($room.($i+1), $schemas[$room]["bunk_bed"], $schemas[$room]["simple_bed"]);
}

$slots = 0;
foreach($lodging as $room) {
	foreach($room->getBeds() as $bed) 
		$slots += $bed->getSlots();
}

foreach($members as $member) {
	$free_rooms = filterFullRooms($lodging);

	$room_id = $free_rooms[array_rand($free_rooms)]->getId();
	$lodging[findIndexById($lodging, $room_id)]->addMember($member);
}

dd($lodging);


function filterFullRooms(array $rooms) : array
{
	$filtered_rooms = [];
	foreach($rooms as $room) {
		if(!$room->isFull())
			$filtered_rooms[] = $room;
	}
	return $filtered_rooms;
}

function findIndexById(array $rooms, string $id) : int
{
	foreach($rooms as $index => $room) {
		if($room->getId() === $id)
			return $index;
	}
	throw new \Exception(sprintf("No room with id %s found into this array", $id));
}

// $rooms = [];
// $room = new Room(2, 2);

// dd($room);








function dd(...$args) {
	foreach($args as $arg) print_r($arg);
}