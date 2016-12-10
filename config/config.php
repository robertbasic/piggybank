<?php

declare(strict_types=1);

return array_merge_recursive(
    require 'database.php',
    require 'dependencies.php',
    require 'routes.php',
    require 'templates.php'
);
