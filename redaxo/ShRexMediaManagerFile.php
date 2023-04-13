<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 * License: MIT
 */
class ShRexMediaManagerFile {

    private string $fileName;
    private rex_media $media;

    public function __construct(string $fileName = null)
    {
        if (!$fileName) {
            $this->fileName = rex_global_settings::getValue("placeholderImage");
        } else {
            $this->fileName = $fileName;
        }
        $media = rex_media::get($this->fileName);
        if(!$media) {
            $this->fileName = rex_global_settings::getValue("placeholderImage");
            $media = rex_media::get($this->fileName);
        }
        $this->media = $media;
    }

    function getMedia() : rex_media {
        return $this->media;
    }

    function getTitle() : string {
        return $this->media->getTitle();
    }

    function getImageSrc($type = "default") : string {
        return  "/index.php?rex_media_type={$type}&rex_media_file={$this->fileName}";
    }

    function getFileUrl() : string {
        return  "/media/{$this->fileName}";
    }
}
