<?php

namespace Premialabs\Foundation;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FoundationRoutes
{
  public static function register(array $objects)
  {
    foreach ($objects as $object) {
      $class = "Premialabs\\Foundation\\" . $object . "\\" . $object . "Controller";

      $routes = $class::routes();
      if (sizeof($routes) > 0) {
        foreach ($routes as $route) {
          Log::info($route);
          list($end_point, $method, $action) = $route;
          if ($method == "GET") {
            Route::get("fnd/" . Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "POST") {
            Route::post("fnd/" . Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "PUT") {
            Route::put("fnd/" . Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "PATCH") {
            Route::patch("fnd/" . Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          } elseif ($method == "DELETE") {
            Route::delete("fnd/" . Str::camel(Str::plural($object)) . "/" . $end_point, $class . '@' . $action);
          }
        }
      }
    }
  }
}
