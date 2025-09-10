<?php
require __DIR__ . '/vendor/autoload.php';

use PhpMqtt\Client\MqttClient;

require_once 'src/DatabaseManager.php';
require_once 'src/MqttSubscriber.php';

$apiKey = "b1YlVT3kucb94ViFVMDd4B3c7KvfRfYWMXAIKLuZWmtYVT4lTKpE83AjKD3HIqd70YqQ9so37UpzOzEotq4eo6M0SVwAoZ046zaqHzUVZV4lz25pwbfQ1BCARh9P5EClDiajiIJZB";
$channel = 'data/counter/iotproject/' . $apiKey;

$mqttServer = 'broker.hivemq.com';
$mqttPort = 1883;
$clientId = 'php-subscriber-' . uniqid();

$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => 'admin',
    'database' => 'counter',
    'port' => 8889,
    'socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
];

// Inisialisasi dependensi
$databaseManager = new DatabaseManager($dbConfig);
$mqttClient = new MqttClient($mqttServer, $mqttPort, $clientId);

// Inisialisasi subscriber
$subscriber = new MqttSubscriber($mqttClient, $databaseManager, $channel);

// Jalankan subscriber
$subscriber->run();

// Tutup koneksi saat skrip selesai
$subscriber->disconnect();