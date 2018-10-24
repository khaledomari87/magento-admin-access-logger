<?php

class KO_Logger_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }
}