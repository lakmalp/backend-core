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
Below is a sample of routes being exposed for _RolePermission_ model.
#### POST: api/fnd/rolePermissions
Creates a new _RolePermission_ model.

#### GET: api/fnd/rolePermissions
Fetch all of _RolePermission_ models. The response is governed by `App\Src\RolePermission\gen\RolePermissionView`.

#### DELETE: api/fnd/rolePermissions
Bulk deletion of multiple _RolePermission_ models.

#### GET: api/fnd/rolePermissions/prepareCreate
Returns a response with default values when a new _RolePermission_ model is about to create.

#### GET: api/fnd/rolePermissions/{rolePermission}/prepareEdit
Returns a response with object along with other details supportive for editing.

#### GET: api/fnd/rolePermissions/{rolePermission}/prepareDuplicate
Returns a response with default values along with copied values from the source object when a new _RolePermission_ model is about to duplicate.

#### PATCH: api/fnd/rolePermissions/{rolePermission}
Update existing _RolePermission_ model.

#### GET: api/fnd/rolePermissions/{rolePermission}
Fetch the specified _RolePermission_ model. The response is governed by `App\Src\RolePermission\gen\RolePermissionWithParentsView`.

#### DELETE: api/fnd/rolePermissions/{rolePermission}
Deletes specified _RolePermission_ model.

Routes for _Permission_, _Role_, and _UserRole_ will be generated as given above.