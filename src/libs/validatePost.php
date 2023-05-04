<?php

function validatePost($title, $content) {
    $errors = [];
    if ($title === '') {
        $errors['title'] = 'タイトルが空です';
    } elseif (strlen($title) > 255) {
        $errors['title'] = 'タイトルは255文字以内でなければなりません';
    }
    if ($content === '') {
        $errors['title'] = 'タイトルが空です';
    } elseif (strlen($content) > 20000) {
        $errors['title'] = 'タイトルは20000文字以内でなければなりません';
    }
    return $errors;
}
