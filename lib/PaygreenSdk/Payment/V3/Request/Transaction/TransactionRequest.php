<?php

namespace Paygreen\Sdk\Payment\V3\Request\Transaction;

use GuzzleHttp\Psr7\Request;
use Paygreen\Sdk\Core\Encoder\JsonEncoder;
use Paygreen\Sdk\Core\Normalizer\CleanEmptyValueNormalizer;
use Paygreen\Sdk\Core\Serializer\Serializer;
use Psr\Http\Message\RequestInterface;

class TransactionRequest extends \Paygreen\Sdk\Core\Request\Request
{
    /**
     * @param string|null $requesterShopId
     * @param string|null $beneficiaryShopId
     * @param int $maxPerPage
     * @param int $page
     *
     * @return Request|RequestInterface
     */
    public function getListRequest(
        $requesterShopId = null,
        $beneficiaryShopId = null,
        $maxPerPage = 10,
        $page = 1
    ) {
        if ($requesterShopId === null) {
            $requesterShopId = $this->environment->getShopId();
        }

        $body = [
            'requester_shop_id' => $requesterShopId,
            'shop_id' => $beneficiaryShopId,
            'max_per_page' => $maxPerPage,
            'page' => $page
        ];

        return $this->requestFactory->create(
            "/payment/transactions",
            (new Serializer([new CleanEmptyValueNormalizer()], [new JsonEncoder()]))->serialize($body, 'json'),
            'GET'
        )->withAuthorization()->isJson()->getRequest();
    }

    /**
     * @param string $transactionId
     *
     * @return Request|RequestInterface
     */
    public function getGetRequest($transactionId)
    {
        return $this->requestFactory->create(
            "/payment/transactions/$transactionId",
            null,
            'GET'
        )->withAuthorization()->isJson()->getRequest();
    }
}
