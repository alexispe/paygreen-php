<?php

namespace Paygreen\Sdk\Charity\V2\Request;

use Paygreen\Sdk\Core\Exception\ConstraintViolationException;
use Paygreen\Sdk\Core\Validator\Validator;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PartnershipRequest extends \Paygreen\Sdk\Core\Request\Request
{
    /**
     * @return RequestInterface
     */
    public function getGroupsRequest()
    {
        return $this->requestFactory->create(
            "/partnership-group",
            null,
            'GET'
        )->withAuthorization()->getRequest();
    }
}