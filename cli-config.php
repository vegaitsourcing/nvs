<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__.'/app/bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);
