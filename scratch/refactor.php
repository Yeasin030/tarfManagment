<?php
$files = [
    'resources/views/turf-show.blade.php',
    'resources/views/tournaments.blade.php',
    'resources/views/offers.blade.php',
    'resources/views/membership.blade.php',
    'resources/views/booking/success.blade.php',
    'resources/views/booking/checkout.blade.php',
    'resources/views/auth/verify.blade.php',
    'resources/views/auth/register.blade.php',
    'resources/views/auth/login.blade.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // We want to replace from <!DOCTYPE html> until the closing </nav> tag
    $content = preg_replace('/<!DOCTYPE html>.*?<\/nav>\s*/s', "@extends('layouts.app')\n\n@section('content')\n", $content);
    
    // We want to replace from <!-- Footer --> or <footer> to the end of the document
    if (strpos($content, '<!-- Footer -->') !== false) {
        $content = preg_replace('/<!-- Footer -->.*<\/html>/s', "\n@endsection\n", $content);
    } else {
        $content = preg_replace('/<footer.*<\/html>/s', "\n@endsection\n", $content);
    }
    
    file_put_contents($file, $content);
    echo "Refactored $file\n";
}
