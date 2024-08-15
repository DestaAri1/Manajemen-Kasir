<?php

if (! function_exists('formatRupiah')) {
    function formatRupiah(float $number): string
    {
        return number_format($number, 0, ',', '.');
    }
}
