<?php

namespace Micro\Plugin\Ffmpeg\Business\FfmpegFactory;

use FFMpeg\FFMpeg;
use Micro\Plugin\Ffmpeg\Configuration\FfmpegPluginConfigurationInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

class FfmpegFactory implements FfmpegFactoryInterface
{
    /**
     * @param FfmpegPluginConfigurationInterface $pluginConfiguration
     * @param LoggerFacadeInterface $loggerFacade
     */
    public function __construct(
        private readonly FfmpegPluginConfigurationInterface $pluginConfiguration,
        private readonly LoggerFacadeInterface $loggerFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function create(): FFMpeg
    {
        $loggerName = $this->pluginConfiguration->getLogger();
        $logger = null;
        if($loggerName) {
            $logger = $this->loggerFacade->getLogger($loggerName);
        }

        $cfg = [
            'ffmpeg.binaries'   => $this->pluginConfiguration->getFfmpegBinaryPath(),
            'ffprobe.binaries'  => $this->pluginConfiguration->getFfprobeBinaryPath(),
            'timeout'           => $this->pluginConfiguration->getProcessTimeout(),
            'ffmpeg.threads'    => $this->pluginConfiguration->getThreadsCount(),
        ];

        return FFMpeg::create($cfg,$logger);
    }
}