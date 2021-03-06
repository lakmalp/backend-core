<?php

namespace Premialabs\Foundation;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AppRoutes
{
  public static function register(array $objects)
  {
    foreach ($objects as $object) {
      $class = "App\\Src\\" . $object . "\\" . $object . "Controller";

      $routes = $class::routes();
      if (sizeof($routes) > 0) {
        foreach ($routes as $route) {
          list($end_point, $method, $action) = $route;
          if ($method == "GET") {
            Route::get(Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "POST") {
            Route::post(Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "PUT") {
            Route::put(Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "PATCH") {
            Route::patch(Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "DELETE") {
            Route::delete(Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          }
        }
      }
    }
  }
}
