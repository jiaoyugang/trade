<?php
require dirname(__DIR__).'/../trade/vendor/autoload.php';

use Kongflower\Pay\Event\Event;

Event::on('start',function($key,$value){
    var_dump($key,$value);
});



Event::trigger('start',array(1,2));