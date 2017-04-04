<?php

function getHeaders () : array
{

    $headers = [];

    foreach ($_SERVER as $key => $value) {

        $key = mb_strtoupper($key);

        if ('HTTP_' !== substr($key, 0, 5)) {
            continue;
        }

        $key = str_replace('_', '-',
            substr($key, 5)
        );

        if ('false' === mb_strtolower($value)) {
            $value = false;
        }

        if ('true' === mb_strtolower($value)) {
            $value = true;
        }

        $headers[$key] = $value;
    }

    return $headers;
}

$headers = getHeaders();

if (empty($headers)) {
    die('no header detected');
}

if ('foo' === $headers['AUTHORIZATION']) {
    echo "foo";
}

if ('baz' === $headers['BEHAT']) {
    echo "baz";
}

