<?php
require_once __DIR__ . '/vendor/autoload.php';
include_once(dirname(__FILE__) . '/app/config/config.php');
include_once(dirname(__FILE__) . '/app/api/Cronjos/Domain/Repository/CronjosRepository.php');

use App\Cronjos\Domain\Repository\CronjosRepository;

$cronjob = new CronjosRepository();


echo $cronjob->CronWhatsApp();
