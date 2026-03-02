<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CurrencyGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\CurrencyGui\Communication\CurrencyGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @uses \Spryker\Zed\CurrencyGui\Communication\Table\CurrencyStoreTable::PARAM_STORE_ID
     *
     * @var string
     */
    protected const PARAM_STORE_ID = 'store-id';

    public function assignedCurrencyTableAction(Request $request): JsonResponse
    {
        $table = $this->getFactory()->createAssignedCurrencyStoreTable($this->getIdStore($request));

        return $this->jsonResponse(
            $table->fetchData(),
        );
    }

    public function assignedCurrencyTableSelectableAction(Request $request): JsonResponse
    {
        $table = $this->getFactory()->createSelectableAssignedCurrencyStoreTable($this->getIdStore($request));

        return $this->jsonResponse(
            $table->fetchData(),
        );
    }

    public function availableCurrencyTableSelectableAction(Request $request): JsonResponse
    {
        $table = $this->getFactory()->createSelectableAvailableCurrencyStoreTable($this->getIdStore($request));

        return $this->jsonResponse(
            $table->fetchData(),
        );
    }

    protected function getIdStore(Request $request): ?int
    {
        $idStore = $request->get(static::PARAM_STORE_ID);

        if ($idStore === null) {
            return null;
        }

        return $this->castId($idStore);
    }
}
