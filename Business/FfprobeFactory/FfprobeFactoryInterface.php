<?php

namespace Micro\Plugin\Ffmpeg\Business\FfprobeFactory;

use FFMpeg\FFProbe;

interface FfprobeFactoryInterface
{
    /**
     * @return FFProbe
     */
    public function create(): FFProbe;
}