<?php

$servername = "localhost:3307"; //server name with port
$username = "username"; //username
$password = "password"; //password
$db = "hum_temp_db";

if (isset($_GET["temp"])) {
    $temperature = $_GET["temp"];
}
if (isset($_GET["hum"])) {
    $humidity = $_GET["hum"];
}


$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::FETCH_ASSOC, PDO::ERRMODE_EXCEPTION);

if (isset($temperature) && isset($humidity)) {
    $insert = $conn->prepare("INSERT INTO temperature_humidity (temperature,humidity,date) VALUES (:temperature,:humidity,:date)");
    $insert->bindValue(':temperature', $temperature);
    $insert->bindValue(':humidity', $humidity);
    $insert->bindValue(':date', date("H:i"));
    $insert->execute();
}


$print = $conn->prepare("SELECT temperature,humidity,date FROM temperature_humidity");
$print->execute();
$result = $print->fetchAll(PDO::FETCH_ASSOC);


$temperature_array = [];
$humidity_array = [];
$date_array = [];

//we verify if array has at least 29 records and then we add records at the beginning of arrays 
if (count($result) >= 29) {
    for ($i = count($result) - 1; $i > count($result) - 30; $i--) {
        $data = $result[$i];
        array_unshift($temperature_array, $data["temperature"]);
        array_unshift($humidity_array, $data["humidity"]);
        array_unshift($date_array, $data["date"]);
    }

    //convert arrays to string for use in JavaScript
    $temperature_string = implode(",", $temperature_array);
    $humidity_string = implode(",", $humidity_array);
    $date_string = implode("\",\"", $date_array);
    $date_string = "\"" . $date_string . "\"";
}
