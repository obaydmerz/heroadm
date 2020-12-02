<?php
namespace HeroADM\App\Source\Modules;

class QR {
    public function url($path = "", $host = "", $client = "http", $width = 300, $height = 300){
        if($host != ""){
            return "https://chart.apis.google.com/chart?cht=qr&chs=" . $width . "x" . $height . "&chl=$client://$host/$path";
        }

        return "https://chart.apis.google.com/chart?cht=qr&chs=" . $width . "x" . $height . "&chl=/$path";
    }

    public function text($text = "Test", $width = 300, $height = 300){
       return "https://chart.apis.google.com/chart?cht=qr&chs=" . $width . "x" . $height . "&chl=$text";
    }
}
