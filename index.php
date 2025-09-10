<?php
require('vendor/autoload.php'); // Pastikan Anda sudah menginstal library MQTT

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

$server   = 'broker.hivemq.com';
$port     = 1883;
$clientId = 'php-subscriber-' . rand();

// Buat koneksi ke MySQL
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "counter";
$dbport = 8889;

$conn = new mysqli($servername, $username, $password, $dbname, $dbport);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi klien MQTT
$mqtt = new MqttClient($server, $port, $clientId);
$mqtt->connect();

// Berlangganan ke topik yang sama dengan ESP32
$mqtt->subscribe('data/counter/iotproject', function ($topic, $message) use ($conn) {
    echo "Pesan diterima di topik '$topic': $message\n";

    $count = (int)$message; // Konversi pesan ke integer

    // Siapkan query SQL
    $sql = "INSERT INTO counter_data (count_value, timestamp) VALUES ('$count', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "\n";
    }
}, 0);

// Mulai loop untuk terus mendengarkan pesan
$mqtt->loop(true);

$mqtt->disconnect();
$conn->close();
