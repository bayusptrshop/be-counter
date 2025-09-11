<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter App Realtime</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .counter-display {
            background: linear-gradient(135deg, #1583ff 0%, #0d6efd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(21, 131, 255, 0.3);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: rgba(21, 131, 255, 0.1);
            transform: translateX(4px);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
            animation: pulse 2s infinite;
        }

        .floating-element {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1583ff 0%, #0d6efd 50%, #4dabf7 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1583ff 0%, #0d6efd 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(21, 131, 255, 0.3);
        }

        .data-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        @media (max-width: 768px) {
            .counter-display {
                font-size: 4rem;
            }
        }
    </style>
</head>

<body class="min-h-screen gradient-bg">
    <!-- Background decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full floating-element"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full floating-element" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full floating-element" style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 py-6 max-w-7xl relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="status-indicator"></div>
                <span class="text-white/80 text-sm font-medium">SYSTEM ONLINE</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-3 drop-shadow-lg">
                Counter App
                <span class="block text-3xl md:text-4xl font-light text-white/90">Realtime</span>
            </h1>
            <p class="text-white/80 text-lg max-w-md mx-auto">Real-time item entry calculation system</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Count Card -->
            <div class="lg:col-span-2 glass-card rounded-3xl p-8 text-center card-shadow">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <svg class="w-8 h-8" style="color: #1583ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800">Count</h2>
                </div>
                <div class="counter-display text-7xl md:text-8xl font-bold mb-4 pulse-animation" id="counterDisplay">0</div>
                <div class="text-sm text-gray-700 bg-white/80 rounded-full px-4 py-2 inline-block border border-gray-200">
                    Number of incoming items
                </div>
            </div>

            <!-- Time Info Card -->
            <div class="glass-card rounded-3xl p-8 text-center card-shadow">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <svg class="w-8 h-8" style="color: #1583ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Last Entry</h2>
                </div>
                <div class="text-3xl font-bold mb-2" style="color: #1583ff;" id="lastEntryTime">--:--:--</div>
                <div class="text-lg text-gray-600 mb-4" id="lastEntryDate">-- --- ----</div>
                <div class="bg-white/80 border border-blue-200 rounded-xl p-3">
                    <div class="text-sm text-gray-700 mb-1">Current Time</div>
                    <div id="currentTime" class="font-semibold" style="color: #1583ff;"></div>
                </div>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="data-card rounded-3xl p-6 md:p-8 card-shadow">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" style="color: #1583ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Data Items</h2>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600 bg-white/50 rounded-full px-4 py-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Live Data</span>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl bg-white/90 backdrop-blur-sm border border-gray-200">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-blue-200 bg-gradient-to-r from-blue-50 to-blue-100">
                            <th class="text-left py-5 px-6 font-semibold text-gray-800 text-sm uppercase tracking-wider">No</th>
                            <th class="text-left py-5 px-6 font-semibold text-gray-800 text-sm uppercase tracking-wider">Device ID</th>
                            <th class="text-left py-5 px-6 font-semibold text-gray-800 text-sm uppercase tracking-wider">Count</th>
                            <th class="text-left py-5 px-6 font-semibold text-gray-800 text-sm uppercase tracking-wider">Entry Time</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable" class="divide-y divide-gray-100">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>

                <!-- Empty State -->
                <div id="emptyState" class="text-center py-12 hidden">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">No data has been entered yet.</p>
                    <p class="text-gray-400 text-sm">Data will appear in real time when the device sends information.</p>
                </div>
            </div>
        </div>

        <!-- Connection Status -->
        <div class="fixed bottom-6 right-6 z-50">
            <div id="connectionStatus" class="bg-white/95 border border-gray-300 rounded-full px-4 py-2 flex items-center gap-2 text-sm font-medium shadow-lg">
                <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                <span class="text-gray-800">Connecting...</span>
            </div>
        </div>
    </div>

    <!-- MQTT Script -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        // MQTT Configuration
        const mqttServer = 'broker.hivemq.com';
        const mqttPort = 8884;
        const mqttTopic = 'data/counter/iotproject/b1YlVT3kucb94ViFVMDd4B3c7KvfRfYWMXAIKLuZWmtYVT4lTKpE83AjKD3HIqd70YqQ9so37UpzOzEotq4eo6M0SVwAoZ046zaqHzUVZV4lz25pwbfQ1BCARh9P5EClDiajiIJZB';
        const clientId = 'web-client-' + Math.random().toString(16).substr(2, 8);

        // Global variables
        let totalCount = 0;
        let dataEntries = [];
        let client;

        // DOM elements
        const counterDisplay = document.getElementById('counterDisplay');
        const lastEntryTime = document.getElementById('lastEntryTime');
        const lastEntryDate = document.getElementById('lastEntryDate');
        const currentTime = document.getElementById('currentTime');
        const dataTable = document.getElementById('dataTable');
        const emptyState = document.getElementById('emptyState');
        const connectionStatus = document.getElementById('connectionStatus');

        // Update current time
        function updateCurrentTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US');
            currentTime.textContent = timeString;
        }

        // Update connection status
        function updateConnectionStatus(status, message) {
            const statusElement = connectionStatus.querySelector('div');
            const textElement = connectionStatus.querySelector('span');

            statusElement.className = 'w-3 h-3 rounded-full';

            switch (status) {
                case 'connecting':
                    statusElement.classList.add('bg-yellow-500', 'animate-pulse');
                    textElement.textContent = 'Connecting...';
                    break;
                case 'connected':
                    statusElement.classList.add('bg-green-500', 'animate-pulse');
                    textElement.textContent = 'Connected';
                    break;
                case 'disconnected':
                    statusElement.classList.add('bg-red-500', 'animate-pulse');
                    textElement.textContent = 'Disconnected';
                    break;
            }
        }

        // Update counter display with animation
        function updateCounter(newCount) {
            totalCount = newCount;
            counterDisplay.style.transform = 'scale(1.1)';
            counterDisplay.textContent = totalCount;

            setTimeout(() => {
                counterDisplay.style.transform = 'scale(1)';
            }, 200);
        }

        // Update last entry time
        function updateLastEntryTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US');
            const dateString = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            lastEntryTime.textContent = timeString;
            lastEntryDate.textContent = dateString;
        }

        // Update data table
        function updateDataTable() {
            if (dataEntries.length === 0) {
                dataTable.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');

            const tableHTML = dataEntries.map((entry, index) => `
                <tr class="table-row hover:bg-blue-50 cursor-pointer">
                    <td class="py-4 px-6 text-gray-800 font-medium">${index + 1}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-gray-800 font-mono text-sm">${entry.deviceId}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background-color: rgba(21, 131, 255, 0.1); color: #1583ff;">
                            ${entry.count}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-gray-600">${entry.timestamp}</td>
                </tr>
            `).join('');

            dataTable.innerHTML = tableHTML;
        }

        // Process incoming MQTT data
        function processData(data) {
            try {
                const parsedData = JSON.parse(data);
                const deviceId = parsedData.device_id || 'Unknown';
                const count = parsedData.count || 0;
                const timestamp = new Date().toLocaleString('en-US');

                // Add new entry
                dataEntries.unshift({
                    deviceId: deviceId,
                    count: count,
                    timestamp: timestamp
                });

                // Keep only last 50 entries
                if (dataEntries.length > 50) {
                    dataEntries = dataEntries.slice(0, 50);
                }

                // Update displays
                updateCounter(count);
                updateLastEntryTime();
                updateDataTable();

            } catch (error) {
                console.error('Error processing data:', error);
            }
        }

        // Initialize MQTT connection
        function initMQTT() {
            updateConnectionStatus('connecting');

            const options = {
                port: mqttPort,
                clientId: clientId,
                keepalive: 60,
                clean: true,
                reconnectPeriod: 1000,
                connectTimeout: 30 * 1000,
            };

            const connectUrl = `wss://${mqttServer}:${mqttPort}/mqtt`;
            client = mqtt.connect(connectUrl, options);

            client.on('connect', () => {
                console.log('Connected to MQTT broker');
                updateConnectionStatus('connected');

                client.subscribe(mqttTopic, (err) => {
                    if (err) {
                        console.error('Subscription error:', err);
                    } else {
                        console.log('Subscribed to topic:', mqttTopic);
                    }
                });
            });

            client.on('message', (topic, message) => {
                const data = message.toString();
                console.log('Received data:', data);
                processData(data);
            });

            client.on('error', (error) => {
                console.error('MQTT error:', error);
                updateConnectionStatus('disconnected');
            });

            client.on('close', () => {
                console.log('MQTT connection closed');
                updateConnectionStatus('disconnected');
            });
        }

        // Initialize application
        function init() {
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);
            updateDataTable(); // Show empty state initially
            initMQTT();
        }

        // Start the application
        init();
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'97d44babb57efd9f',t:'MTc1NzU2MzYxOS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>