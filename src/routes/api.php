<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Premialabs\Foundation\AppRoutes;
use Premialabs\Foundation\FoundationRoutes;
use Premialabs\Foundation\AuditableModelController;
use Premialabs\Foundation\SystemParameterController;

AppRoutes::register(config('premialabs.routes', []));

Route::get('/user', function (Request $request) {
  return $request->user();
});

AuditableModelController::routes();
SystemParameterController::routes();

FoundationRoutes::register([
  'PrintPreviewer',
  'ReportUtility',
  'Permission',
  'Role',
  'UserRole',
  'RolePermission'
]);
