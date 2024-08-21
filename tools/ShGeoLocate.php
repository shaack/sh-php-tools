<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShGeoLocate
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function geoLocate($street, $hsnr, $plz, $city): array
    {
        $address = urlencode($street . " " . $hsnr . ", " . $plz . " " . $city);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$this->apiKey";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if ($data["status"] === "OK") {
            $location = $data["results"][0]["geometry"]["location"];
            return [$location["lat"], $location["lng"]];
        } else {
            return [null, null];
        }
    }
}