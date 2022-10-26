<?php

namespace Micro\Plugin\Ffmpeg;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Ffmpeg\Business\FfmpegFactory\FfmpegFactory;
use Micro\Plugin\Ffmpeg\Business\FfmpegFactory\FfmpegFactoryInterface;
use Micro\Plugin\Ffmpeg\Configuration\FfmpegPluginConfigurationInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacade;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

/**
 * @method FfmpegPluginConfigurationInterface configuration()
 */
class FfmpegPlugin extends AbstractPlugin
{
    protected ?LoggerFacadeInterface $loggerFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FfmpegFacadeInterface::class, function (LoggerFacadeInterface $loggerFacade) {
            $this->loggerFacade = $loggerFacade;

            return new FfmpegFacade(
                $this->createFfmpegFactory()
            );
        });
    }

    /**
     * @return FfmpegFactoryInterface
     */
    protected function createFfmpegFactory(): FfmpegFactoryInterface
    {
        return new FfmpegFactory(
            pluginConfiguration: $this->configuration(),
            loggerFacade: $this->loggerFacade
        );
    }
}

