#!/usr/bin/env php
<?php

include __DIR__ . '/../vendor/autoload.php';

$path = isset($argv[1]) ? $argv[1] : FALSE;

if (!is_file($path) && is_readable($path)) {
    throw new \InvalidArgumentException('Invalid input path.');
}

$output = \MarsRover\Application::run($path);

echo $output;