<?php

namespace Premialabs\Foundation;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class SystemParameterController extends Controller
{
    public static function routes()
    {
        Route::get('/fnd/systemParameters', [SystemParameterController::class, 'index']);
        Route::post('/fnd/systemParameters', [SystemParameterController::class, 'update']);
    }

    private function _validateValueType($sys_p, $value)
    {
        $_value = $value;
        switch ($sys_p->value_type) {
            case 'boolean':
                $_value = ($value === 'YES');
                if (!is_bool($_value)) {
                    throw new Exception("Invalid value for " . $sys_p->code);
                }
                break;

            default:
                # code...
                break;
        }
    }

    public function index()
    {
        $is_super = (auth()->user()->name === 'Superadmin');
        if ($is_super) {
            $recs = SystemParameter::get();
        } else {
            $recs = SystemParameter::where('param_type', 'USER')->get();
        }
        return $recs;
    }

    public function getValue(SystemParameter $systemParameter)
    {
        return response()->json([$systemParameter->value], 200);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->all() as $code => $value) {
                $sys_p = SystemParameter::where('code', $code)->first();
                $this->_validateValueType($sys_p, $value);
                $sys_p->update(['value' => $value]);
            }
            DB::commit();
            return response()->json($this->index(), 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
