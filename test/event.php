<?php
require dirname(__DIR__).'/../trade/vendor/autoload.php';

use Kongflower\Pay\Event\Event;

Event::on('start',function(){
    var_dump(['code' => 200]);
});


Event::trigger('start',array(1,2));