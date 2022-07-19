<?php

namespace Premialabs\Foundation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FndDatabaseController extends Controller
{

    /**
     * Model related routes
     *
     * Template:
     * `['<END_POINT>', '<METHOD>', '<CONTROLLER_METHOD>']`
     * 
     * `<METHOD>` can be any of GET, PUT, PATCH, DELETE, and POST
     * 
     * e.g. `['prepareCreate', 'GET', 'prepareCreate']` will generate a GET route: `/model/prepareCreate` and the request will be forwarded to `prepareCreate` method of the ModelController with `\Illuminate\Http\Request` type param.
     * 
     * _Note_: Pay attention to specificity
     *
     * @author  Lakmal Premaratne <lakmalp@gmail.com>
     *
     */
    public static function routes(): array
    {
        return [
            // create
            ['prepareCreate', 'GET', 'prepareCreate'],
            ['prepareDuplicate', 'GET', 'prepareDuplicate'],
            ['', 'POST', 'create'],

            // update
            ['{site}/prepareEdit', 'GET', 'prepareEdit'],
            ['{site}', 'PATCH', 'update'],

            // read
            ['{site}', 'GET', 'show'],
            ['', 'GET', 'query'],

            // delete
            ['{site}', 'DELETE', 'delete'],
            ['', 'DELETE', 'bulkDelete'],
        ];
    }

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

    public function prepareEdit($id)
    {
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
