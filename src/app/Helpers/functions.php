<?php
// Вспомогательные функции (CSRF, редиректы, флеши, и т.д.)
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function check_csrf($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function flash($key, $msg = null) {
    if ($msg !== null) {
        $_SESSION['flash'][$key] = $msg;
    } else {
        $out = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $out;
    }
}
