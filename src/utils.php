<?php

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// For WYSIWYG HTML content: allow safe tags, strip scripts to prevent XSS.
function sanitize_html($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $allowed = '<p><br><strong><em><u><s><a><ul><ol><li><h1><h2><h3><span>';
    return strip_tags($data, $allowed);
}

?>