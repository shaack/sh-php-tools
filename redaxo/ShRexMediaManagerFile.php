<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * License: MIT
 */
class ShRexMediaManagerFile {

    private string $type;
    private string $media;
    private string $fileName;

    public function __construct(string $fileName = null, string $type = "file")
    {
        if (!$fileName) {
            $this->fileName = rex_global_settings::getValue("placeholderImage", 1);
        }
        $this->media = rex_media::get($this->fileName);
        $this->type = $type;
    }

    function getMedia() {
        return $this->media;
    }

    function getImageSrc() {
        return  "/index.php?rex_media_type={$this->type}&rex_media_file={$this->fileName}";
    }

    function getFileUrl() {
        return  "/media/{$this->fileName}";
    }
}
