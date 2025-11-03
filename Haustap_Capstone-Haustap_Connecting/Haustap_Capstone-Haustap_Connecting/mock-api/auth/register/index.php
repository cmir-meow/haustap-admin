<?php
// Dev-only register stub to unblock UI while backend is unavailable.
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['message' => 'Method Not Allowed']);
  exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];

$firstName = trim($data['firstName'] ?? '');
$lastName  = trim($data['lastName'] ?? '');
$email     = trim($data['email'] ?? '');
$mobile    = trim($data['mobile'] ?? '');
$birthMonth = trim($data['birthMonth'] ?? '');
$birthDay   = trim($data['birthDay'] ?? '');
$birthYear  = trim($data['birthYear'] ?? '');

// Very basic validation for dev
if ($firstName === '' || $lastName === '' || $email === '' || $mobile === '') {
  http_response_code(422);
  echo json_encode(['message' => 'Missing required fields']);
  exit;
}

$user = [
  'id' => 2,
  'name' => trim($firstName . ' ' . $lastName),
  'firstName' => $firstName,
  'lastName' => $lastName,
  'email' => $email,
  'mobile' => $mobile,
  'dob' => ($birthMonth && $birthDay && $birthYear) ? ($birthMonth . '/' . $birthDay . '/' . $birthYear) : null,
  'role' => ['name' => 'client'],
];

http_response_code(201);
echo json_encode([
  'success' => true,
  'token' => 'dev-token-register-456',
  'user' => $user,
]);
exit;