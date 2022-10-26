<?php

namespace Micro\Plugin\Ffmpeg\Facade;

use FFMpeg\Media\Audio;
use FFMpeg\Media\Video;
use Micro\Plugin\Ffmpeg\Business\FfmpegFactory\FfmpegFactoryInterface;

class FfmpegFacade implements FfmpegFacadeInterface
{

    public function __construct(
        private readonly FfmpegFactoryInterface $ffmpegFactory
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function open(string $filePath): Audio|Video
    {
        return $this->ffmpegFactory
            ->create()
            ->open($filePath);
    }
}