<?php

namespace Artesaos\Defender\Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Defender - Laravel 5 ACL Package
 * Author: PHP Artesãos.
 */
/**
 * 
 */
class Defender extends BaseConfig
{

    /*
     * Default User model used by Defender.
     *
     * Leave blank for auto discovery
     */
    public $user_model = '';

    /*
     * Default Role model used by Defender.
     */
    public $role_model = \Artesaos\Defender\Role::class;

    /*
     * Default Permission model used by Defender.
     */
    public $permission_model = \Artesaos\Defender\Permission::class;

    /*
     * Roles table name
     */
    public $role_table = 'roles';

    /*
     *
     */
    public $role_key = 'role_id';

    /*
     * Permissions table name
     */
    public $permission_table = 'permissions';

    /*
     *
     */
    public $permission_key = 'permission_id';

    /*
     * Pivot table for roles and users
     */
    public $role_user_table = 'role_user';

    /*
     * Pivot table for permissions and roles
     */
    public $permission_role_table = 'permission_role';

    /*
     * Pivot table for permissions and users
     */
    public $permission_user_table = 'permission_user';

    /*
     * Forbidden callback
     */
    public $forbidden_callback = \Artesaos\Defender\Handlers\ForbiddenHandler::class;

    /*
     * Use blade template helpers
     */
    public $template_helpers = true;

    /*
     * Use helper functions
     */
    public $helpers = true;

    /*
     * Super User role name
     */
    public $superuser_role = 'superuser';

    /*
     * js var name
     */
    public $js_var_name = 'defender';

}
