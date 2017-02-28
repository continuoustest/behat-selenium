<?php

echo "continuousphp";

echo "\n\n --------------- \n\n";

echo "clear_env: ", ini_get('clear_env'), "\n";

echo "BEHAT_BASE_URL: ", getenv('BEHAT_BASE_URL'), "\n";
echo "BEHAT_WD_HOST: ", getenv('BEHAT_WD_HOST'), "\n";

echo "phpversion: ", phpversion(), "\n";
echo "environments: ", print_r($_ENV, true), "\n";
echo "server: ", print_r($_SERVER, true), "\n";