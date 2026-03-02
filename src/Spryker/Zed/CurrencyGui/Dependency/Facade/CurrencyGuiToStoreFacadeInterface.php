<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CurrencyGui\Dependency\Facade;

interface CurrencyGuiToStoreFacadeInterface
{
    public function isDynamicStoreEnabled(): bool;
}
