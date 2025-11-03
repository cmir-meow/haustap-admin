<?php
// Simple mock Bookings API for local preview
// Supports: GET /mock-api/bookings, POST /mock-api/bookings
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  echo json_encode(['success' => true]);
  exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$storeDir = __DIR__ . '/../_data';
$storeFile = $storeDir . '/bookings.json';

function load_store($file) {
  if (is_file($file)) {
    $raw = file_get_contents($file);
    $data = json_decode($raw, true);
    if (is_array($data)) return $data;
  }
  return [];
}

function save_store($file, $data) {
  $dir = dirname($file);
  if (!is_dir($dir)) { @mkdir($dir, 0777, true); }
  file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

function read_json() {
  $raw = file_get_contents('php://input');
  if ($raw === false) return null;
  $data = json_decode($raw, true);
  return is_array($data) ? $data : null;
}

if ($method === 'GET') {
  $items = load_store($storeFile);
  echo json_encode(['success' => true, 'data' => $items]);
  exit;
}

if ($method === 'POST') {
  $payload = read_json();
  if (!$payload) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    exit;
  }

  $items = load_store($storeFile);
  $nextId = 1;
  if ($items) {
    $ids = array_map(function($x){ return (int)($x['id'] ?? 0); }, $items);
    $nextId = max($ids) + 1;
  }

  $booking = [
    'id' => $nextId,
    'provider_id' => (int)($payload['provider_id'] ?? 0),
    'service_name' => (string)($payload['service_name'] ?? 'General Service'),
    'scheduled_date' => $payload['scheduled_date'] ?? null,
    'scheduled_time' => $payload['scheduled_time'] ?? null,
    'address' => $payload['address'] ?? null,
    'status' => 'pending',
    'notes' => (string)($payload['notes'] ?? ''),
    'price' => (float)($payload['price'] ?? 0),
  ];

  $items[] = $booking;
  save_store($storeFile, $items);

  http_response_code(201);
  echo json_encode(['success' => true, 'id' => $booking['id'], 'data' => $booking]);
  exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
?>
