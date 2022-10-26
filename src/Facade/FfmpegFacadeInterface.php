<?php

namespace Micro\Plugin\Ffmpeg\Facade;

use FFMpeg\Media\Audio;
use FFMpeg\Media\Video;

interface FfmpegFacadeInterface
{
    /**
     * Open video or audio file
     *
     * @param string $filePath
     *
     * @return Video|Audio
     */
    public function open(string $filePath): Video|Audio;
}