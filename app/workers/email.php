<?php
chdir(dirname(dirname(__DIR__)));
include './vendor/autoload.php';

$settings = require_once 'app/config/settings.php';

if(file_exists('app/config/settings.local.php')) {
    $settings = array_replace_recursive($settings, require 'app/config/settings.local.php');
}

use Pheanstalk\Pheanstalk;
use IntecPhp\Worker\EmailWorker;
use Pimple\Container as PimpleContainer;

$dependencies = new PimpleContainer();
$dependencies['settings'] = $settings;

require 'app/config/dependencies.php';

$queue = $dependencies[Pheanstalk::class];
$queue
    ->watch($settings['mail']['tube_name'])
    ->ignore('default');

do {
    try {
        $job = $queue->reserve();
        $data = json_decode($job->getData(), true);
        $worker = $dependencies[EmailWorker::class];
        $worker->execute($data);
        $queue->delete($job);
    } catch (\Throwable $e) {
        print $e->getMessage() . "\n";
        $queue->delete($job);
    }
} while (true);
