<?php

declare(strict_types=1);

namespace PiggyBank;

use Zend\View\Helper\AbstractHelper;

class CustomHelper extends AbstractHelper
{
    public function __invoke()
    {
        echo "Hello";
    }
}
