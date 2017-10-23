<?php
declare(strict_types=1);

namespace AccountBook\Library;

use Throwable;

class RedirectException extends \Exception
{
    public function __construct($url = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($url, $code, $previous);
    }
}
