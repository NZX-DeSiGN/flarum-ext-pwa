<?php namespace NZX\Pwa;

use Illuminate\Contracts\Events\Dispatcher;

return function(Dispatcher $events) {
    $events->subscribe(Listeners\AddHeadLinks::class);
};
