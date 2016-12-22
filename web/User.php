<?php
namespace xz1mefx\base\web;

/**
 * Class User
 * @package xz1mefx\base\web
 */
class User extends \yii\web\User
{

    /**
     * Checks if the user cannot perform the operation as specified by the given permission.
     *
     * Note that you must configure "authManager" application component in order to use this method.
     * Otherwise it will always return false.
     *
     * @param string|array $permissionName the name(s) of the permission (e.g. "edit post") that needs access check.
     * @param array        $params         name-value pairs that would be passed to the rules associated
     *                                     with the roles and permissions assigned to the user.
     * @param boolean      $allowCaching   whether to allow caching the result of access check.
     *                                     When this parameter is true (default), if the access check of an operation
     *                                     was performed before, its result will be directly returned when calling this
     *                                     method to check the same operation. If this parameter is false, this method
     *                                     will always call
     *                                     [[\yii\rbac\CheckAccessInterface::checkAccess()]] to obtain the up-to-date
     *                                     access result. Note that this caching is effective only within the same
     *                                     request and only works when `$params = []`.
     *
     * @return boolean whether the user cannot perform the operation as specified by the given permission.
     */
    public function cannot($permissionName, $params = [], $allowCaching = TRUE)
    {
        return !$this->can($permissionName, $params, $allowCaching);
    }

    /**
     * Checks if the user can perform the operation as specified by the given permission.
     *
     * Note that you must configure "authManager" application component in order to use this method.
     * Otherwise it will always return false.
     *
     * @param string|array $permissionName the name(s) of the permission (e.g. "edit post") that needs access check.
     * @param array        $params         name-value pairs that would be passed to the rules associated
     *                                     with the roles and permissions assigned to the user.
     * @param boolean      $allowCaching   whether to allow caching the result of access check.
     *                                     When this parameter is true (default), if the access check of an operation
     *                                     was performed before, its result will be directly returned when calling this
     *                                     method to check the same operation. If this parameter is false, this method
     *                                     will always call
     *                                     [[\yii\rbac\CheckAccessInterface::checkAccess()]] to obtain the up-to-date
     *                                     access result. Note that this caching is effective only within the same
     *                                     request and only works when `$params = []`.
     *
     * @return boolean whether the user can perform the operation as specified by the given permission.
     */
    public function can($permissionName, $params = [], $allowCaching = TRUE)
    {
        if (is_array($permissionName)) {
            foreach (array_unique($permissionName) as $permissionNameItem) {
                if (parent::can($permissionNameItem, $params, $allowCaching)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        return parent::can($permissionName, $params, $allowCaching);
    }

}
