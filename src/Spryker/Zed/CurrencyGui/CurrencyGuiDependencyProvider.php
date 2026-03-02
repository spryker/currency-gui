<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CurrencyGui;

use Orm\Zed\Currency\Persistence\Base\SpyCurrencyStoreQuery;
use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Zed\CurrencyGui\Dependency\Facade\CurrencyGuiToCurrencyFacadeBridge;
use Spryker\Zed\CurrencyGui\Dependency\Facade\CurrencyGuiToStoreFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\CurrencyGui\CurrencyGuiConfig getConfig()
 */
class CurrencyGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CURRENCY = 'FACADE_CURRENCY';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const PROPEL_QUERY_CURRENCY_STORE = 'PROPEL_QUERY_CURRENCY_STORE';

    /**
     * @var string
     */
    public const PROPEL_QUERY_CURRENCY = 'PROPEL_QUERY_CURRENCY';

    /**
     * @var string
     */
    public const RENDERER = 'RENDERER';

    /**
     * @uses \Spryker\Zed\Twig\Communication\Plugin\Application\TwigApplicationPlugin::SERVICE_TWIG
     *
     * @var string
     */
    protected const SERVICE_TWIG = 'twig';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addCurrencyFacade($container);
        $container = $this->addCurrencyStorePropelQuery($container);
        $container = $this->addCurrencyPropelQuery($container);
        $container = $this->addRenderer($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    protected function addCurrencyFacade(Container $container): Container
    {
        $container->set(static::FACADE_CURRENCY, function (Container $container) {
            return new CurrencyGuiToCurrencyFacadeBridge(
                $container->getLocator()->currency()->facade(),
            );
        });

        return $container;
    }

    protected function addStoreFacade(Container $container): Container
    {
        $container->set(static::FACADE_STORE, function (Container $container) {
            return new CurrencyGuiToStoreFacadeBridge(
                $container->getLocator()->store()->facade(),
            );
        });

        return $container;
    }

    protected function addCurrencyStorePropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_CURRENCY_STORE, $container->factory(function () {
            return SpyCurrencyStoreQuery::create();
        }));

        return $container;
    }

    protected function addCurrencyPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_CURRENCY, $container->factory(function () {
            return SpyCurrencyQuery::create();
        }));

        return $container;
    }

    protected function addRenderer(Container $container): Container
    {
        $container->set(static::RENDERER, function (ContainerInterface $container) {
            return $container->getApplicationService(static::SERVICE_TWIG);
        });

        return $container;
    }
}
