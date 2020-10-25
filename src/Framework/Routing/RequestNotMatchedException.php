<?php

namespace Framework\Routing;

/**
 * Class RequestNotMatchedException
 *
 * @package Framework\Routing
 * @author  Farukh Narzullaev <faruh.narzullaev@sibers.com>
 */
class RequestNotMatchedException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
