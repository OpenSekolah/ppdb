<?php

function api_format($success = false, $message = [], $data = [], $pagination = []) {
    $errorData = [];
    foreach($message as $key => $value) {
        $errorData[$key] = $value;
    }
    
    return [
        'success' => (bool) $success,
        'message' => (array) $message,
        'data' => (array) $data,
        'pagination' => (array) $pagination,
    ];
}