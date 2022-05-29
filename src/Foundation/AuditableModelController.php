<?php

namespace Premialabs\Foundation;

use Premialabs\Foundation\AuditableModels;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class AuditableModelController extends Controller
{
    public static function routes()
    {
        Route::get('/fnd/auditableModels/fetch', [AuditableModelController::class, 'fetch']);
        Route::post('/fnd/auditableModels', [AuditableModelController::class, 'create']);
        Route::post('/fnd/auditableModels/{auditableModel}/delete', [AuditableModelController::class, 'delete']);
    }

    private function beingAudited()
    {
        return AuditableModel::all()->toArray();
    }

    public function fetch()
    {
        return response()->json(['beingAudited' => $this->beingAudited(), 'allToBeAudited' => config('premialabs.eligibleModelsForAuditing', [])], 200);
    }

    public function create(Request $request)
    {
        $model = $request->input('model');
        AuditableModel::create(['model' => $model]);
        return response()->json(['beingAudited' => $this->beingAudited(), 'allToBeAudited' => config('premialabs.eligibleModelsForAuditing', [])], 200);
    }

    public function delete(AuditableModel $auditableModel)
    {
        $auditableModel->delete();
        return response()->json(['beingAudited' => $this->beingAudited(), 'allToBeAudited' => config('premialabs.eligibleModelsForAuditing', [])], 200);
    }
}
