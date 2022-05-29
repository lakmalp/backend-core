<?php

namespace Premialabs\Foundation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FndDatabaseController extends Controller
{
    public function show($model)
    {
        return Utilities::fetch($this, 'showRec', [$model]);
    }

    public function query(Request $request)
    {
        return Utilities::fetch($this, 'query', [$request]);
    }

    public function prepareCreate(Request $request)
    {
        return Utilities::fetch($this, 'prepareCreate', [$request]);
    }

    public function create(Request $request)
    {
        return Utilities::exec($this, 'createRec', [$request->toArray()]);
    }

    public function prepareDuplicate($id)
    {
        return Utilities::fetch($this, 'prepareDuplicate', [$id]);
    }

    public function prepareEdit(Request $request)
    {
        $id = $request->query('id');
        return Utilities::fetch($this, 'prepareEdit', [$id]);
    }

    public function update($model, Request $request)
    {
        return Utilities::exec($this, 'updateRec', [$model, $request->toArray()]);
    }

    public function delete($id)
    {
        return Utilities::exec($this, 'deleteRec', [$id]);
    }

    public function bulkDelete(Request $request)
    {
        return Utilities::exec($this, 'bulkDelete', [$request->toArray()]);
    }
}
