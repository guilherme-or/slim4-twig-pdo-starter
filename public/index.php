<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../config/app.php';

(require __DIR__ . '/../config/middleware.php')($app);

(require __DIR__ . '/../config/routes.php')($app);

$app->run();
