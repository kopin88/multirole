<?php

namespace learn88\multirole\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  protected $routeMiddleware = [
      'roles' => \learn88\multirole\Http\CheckRole::class,
  ];
}
