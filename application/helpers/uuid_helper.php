<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_uuid')) {
    function generate_uuid() {
        // Generate 16 random bytes
        $data = random_bytes(16);

        // Modify certain bits according to RFC 4122, section 4.4
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Version 4 (random)
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Variant 1 (RFC 4122)

        // Output the 36-character UUID string
        return sprintf('%s-%s-%s-%s-%s',
            bin2hex(substr($data, 0, 4)),
            bin2hex(substr($data, 4, 2)),
            bin2hex(substr($data, 6, 2)),
            bin2hex(substr($data, 8, 2)),
            bin2hex(substr($data, 10, 6))
        );
    }
}