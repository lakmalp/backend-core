<?php

namespace Premialabs\Foundation;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class FoundationRoutes
{
  public static function register(array $objects)
  {
    foreach ($objects as $object) {
      $class = "Premialabs\\Foundation\\" . $object . "\\" . $object . "Controller";

      $routes = $class::routes();
      if (sizeof($routes) > 0) {
        foreach ($routes as $path => $params) {
          list($method, $action) = $params;
          if ($method == "GET") {
            Route::get(Str::camel(Str::plural($object)) . "/" . $path, $class . '@' . $action);
          } elseif ($method == "POST") {
            Route::post(Str::camel(Str::plural($object)) . "/" . $path, $class . '@' . $action);
          } elseif ($method == "PUT") {
            Route::put(Str::camel(Str::plural($object)) . "/" . $path, $class . '@' . $action);
          }
        }
      }
    }
  }
}
