<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    if (file_exists($file) && is_readable($file)) {
        // Check if it is a .pdf file
        if (preg_match('/\.pdf$/', $file)) {
            $newFileName = substr($file, 5);
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=\"$newFileName\"");
            readfile($file);
        } // Check if it is a .zip file
        elseif (preg_match('/\.zip$/', $file)) {
            $newFileName = substr($file, 5);
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename=" . basename($file));
            readfile($file);
        } // If it is neither, then handle as generic download
        else {
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($file));
            readfile($file);
        }
    } // URL download (for audio files)
    elseif ($file && filter_var($file, FILTER_VALIDATE_URL)) {
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($file));
        readfile($file);
    }
}