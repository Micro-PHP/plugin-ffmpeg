<?php

namespace Micro\Plugin\Ffmpeg;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Ffmpeg\Business\FfmpegFactory\FfmpegFactory;
use Micro\Plugin\Ffmpeg\Business\FfmpegFactory\FfmpegFactoryInterface;
use Micro\Plugin\Ffmpeg\Business\FfprobeFactory\FfprobeFactory;
use Micro\Plugin\Ffmpeg\Business\FfprobeFactory\FfprobeFactoryInterface;
use Micro\Plugin\Ffmpeg\Configuration\FfmpegPluginConfigurationInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacade;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 * @method FfmpegPluginConfigurationInterface configuration()
 */
class FfmpegPlugin implements DependencyProviderInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    protected ?LoggerFacadeInterface $loggerFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FfmpegFacadeInterface::class, function (LoggerFacadeInterface $loggerFacade) {
            $this->loggerFacade = $loggerFacade;
            $ffprobeFactory = $this->createFfprobeFactory();

            return new FfmpegFacade(
                $this->createFfmpegFactory($ffprobeFactory),
                $ffprobeFactory
            );
        });
    }

    /**
     * @return FfprobeFactoryInterface
     */
    protected function createFfprobeFactory(): FfprobeFactoryInterface
    {
        return new FfprobeFactory(
            loggerFacade: $this->loggerFacade,
            pluginConfiguration: $this->configuration()
        );
    }

    /**
     * @param FfprobeFactoryInterface $ffprobeFactory
     *
     * @return FfmpegFactoryInterface
     */
    protected function createFfmpegFactory(FfprobeFactoryInterface $ffprobeFactory): FfmpegFactoryInterface
    {
        return new FfmpegFactory(
            pluginConfiguration: $this->configuration(),
            ffprobeFactory: $ffprobeFactory,
            loggerFacade: $this->loggerFacade
        );
    }
}

