<?php
# func/sanitize_filename.php
function sanitize_filename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9_.]/', '', $filename);
    return $filename;
}