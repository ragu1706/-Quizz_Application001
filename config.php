<?php
// Configure these values in your hosting environment. Never commit real credentials.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'samesite' => 'Lax',
    ]);
    session_start();
}

function env_value(string $key, string $default = ''): string {
    $value = getenv($key);
    return $value === false ? $default : $value;
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void {
    $sent = $_POST['csrf_token'] ?? '';
    if (!is_string($sent) || !hash_equals(csrf_token(), $sent)) {
        http_response_code(403);
        exit('Invalid request token. Please go back, refresh the page, and try again.');
    }
}

function require_teacher(): void {
    if (empty($_SESSION['teacher_authenticated'])) {
        header('Location: ' . base_path() . '/teacher-login.php');
        exit;
    }
}

function base_path(): string {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    foreach (['/endpoint', '/conn'] as $suffix) {
        if (str_ends_with($dir, $suffix)) $dir = substr($dir, 0, -strlen($suffix));
    }
    return rtrim($dir, '/');
}

function redirect_to(string $path): void {
    header('Location: ' . base_path() . '/' . ltrim($path, '/'));
    exit;
}
