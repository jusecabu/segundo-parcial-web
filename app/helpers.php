<?php

function dd(mixed $value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}

function dj(mixed $value): void
{
    echo "<pre>";
    echo json_encode($value);
    echo "</pre>";
    die;
}
