<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

(require __DIR__ . '/../bootstrap/middleware.php')($app);

(require __DIR__ . '/../bootstrap/routes.php')($app);

$app->run();
