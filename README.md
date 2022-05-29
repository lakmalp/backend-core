A Laravel package that provides authentication, authorization, auditing, and CRUD functionality for a Laravel application.

## Dependencies

1. laravel-fortify
2. laravel-sanctum

## Exposed routes
### Routes related to auditing and system parameters
#### POST: api/fnd/auditableModels
Create new _Auditable Model_


#### GET: api/fnd/auditableModels
Fetch information about models being audited and eligible models for auditing

#### POST: api/fnd/auditableModels/{auditableModel}/delete
Deletes specific _Auditable Model_

#### GET: api/fnd/systemParameters
Fetch all _System Parameters_

#### POST: api/fnd/systemParameters
Creates a new _System Parameter_

### Model specific routes
Below is a sample of routes being exposed for _Grant_ model.
#### POST: api/fnd/grants
Creates a new _Grant_ model.

#### GET: api/fnd/grants
Fetch all of _Grant_ models. The response is governed by `App\Src\Grant\gen\GrantView`.

#### DELETE: api/fnd/grants
Bulk deletion of multiple _Grant_ models.

#### GET: api/fnd/grants/prepareCreate
Returns a response with default values when a new _Grant_ model is about to create.

#### GET: api/fnd/grants/{grant}/prepareEdit
Returns a response with object along with other details supportive for editing.

#### GET: api/fnd/grants/{grant}/prepareDuplicate
Returns a response with default values along with copied values from the source object when a new _Grant_ model is about to duplicate.

#### PATCH: api/fnd/grants/{grant}
Update existing _Grant_ model.

#### GET: api/fnd/grants/{grant}
Fetch the specified _Grant_ model. The response is governed by `App\Src\Grant\gen\GrantWithParentsView`.

#### DELETE: api/fnd/grants/{grant}
Deletes specified _Grant_ model.

Routes for _Permission_, _Role_, and _UserRole_ will be generated as given above.