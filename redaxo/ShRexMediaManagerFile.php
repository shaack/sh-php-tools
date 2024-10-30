<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 * License: MIT
 */
class ShRexMediaManagerFile {

    private string $fileName;
    private rex_media $media;

    private bool $isPlaceholder = false;

    public function __construct(string $fileName = null)
    {
        if (!$fileName) {
            $this->fileName = rex_global_settings::getValue("placeholderImage");
            $this->isPlaceholder = true;
        } else {
            $this->fileName = $fileName;
        }
        $media = rex_media::get($this->fileName);
        if(!$media) {
            $this->fileName = rex_global_settings::getValue("placeholderImage");
            $media = rex_media::get($this->fileName);
            $this->isPlaceholder = true;
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

    function getFileName() : string {
        return $this->fileName;
    }

    function isPlaceholder() : bool {
        return $this->isPlaceholder;
    }

    public function getMetaInfo(string $string): int|string|null
    {
        return $this->media->getValue($string);
    }

    public function getFormattedSize()
    {
        $size = $this->media->getSize();
        if($size > 1024 * 1024) {
            return number_format($size / 1024 / 1024, 2, ",", ".") . " MB";
        } else {
            return number_format($size / 1024, 2, ",", ".") . " KB";
        }
    }

}
