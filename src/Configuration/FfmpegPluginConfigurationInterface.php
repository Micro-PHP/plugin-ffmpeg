<?php

namespace Micro\Plugin\Ffmpeg\Configuration;

interface FfmpegPluginConfigurationInterface
{
    /**
     * @return int
     */
    public function getThreadsCount(): int;

    /**
     * @return string
     */
    public function getFfmpegBinaryPath(): string;

    /**
     * @return string
     */
    public function getFfprobeBinaryPath(): string;

    /**
     * @return int
     */
    public function getProcessTimeout(): int;

    /**
     * @return string
     */
    public function getTemporaryPath(): string;

    /**
     * @return string|null
     */
    public function getLogger(): string|null;
}