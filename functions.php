<?php
function createSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

function getPost($slug, $conn) {
    $sql = "SELECT * FROM posts WHERE slug='".mysqli_real_escape_string($conn, $slug)."'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getAllPosts($conn) {
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $posts = [];
    while($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}

function formatDate($date) {
    return date('F j, Y', strtotime($date));
}