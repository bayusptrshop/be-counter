<?php
use PhpMqtt\Client\MqttClient;

class MqttSubscriber {
    private $mqttClient;
    private $databaseManager;
    private $channel;

    public function __construct(MqttClient $mqttClient, DatabaseManager $databaseManager, $channel) {
        $this->mqttClient = $mqttClient;
        $this->databaseManager = $databaseManager;
        $this->channel = $channel;
    }

    public function run() {
        echo "Menghubungkan ke broker MQTT...\n";
        try {
            $this->mqttClient->connect();
            echo "Berhasil terhubung ke broker MQTT.\n";
        } catch (Exception $e) {
            echo "Gagal terhubung ke broker MQTT: " . $e->getMessage() . "\n";
            exit;
        }

        $this->mqttClient->subscribe($this->channel, function ($topic, $message) {
            $this->processMessage($topic, $message);
        }, 0);

        echo "Menunggu pesan MQTT...\n";
        $this->mqttClient->loop(true);
    }

    private function processMessage($topic, $message) {
        echo "Pesan diterima di topik '$topic': $message\n";
        $data = json_decode($message, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($data['count']) && isset($data['device_id'])) {
            $conn = $this->databaseManager->getConnection();
            $count = (int)$data['count'];
            $deviceId = $data['device_id'];
            echo "Data terurai: device_id=$deviceId, count=$count\n";

            $sql = "INSERT INTO counter_data (device_id, count_value, timestamp) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $deviceId, $count);

            if ($stmt->execute()) {
                echo "Data berhasil disimpan!\n";
            } else {
                echo "Error: " . $stmt->error . "\n";
            }
            $stmt->close();
        } else {
            echo "Error: Gagal mengurai JSON atau key tidak ditemukan.\n";
        }
    }

    public function disconnect() {
        $this->mqttClient->disconnect();
        $this->databaseManager->closeConnection();
    }
}