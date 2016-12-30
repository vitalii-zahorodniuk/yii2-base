<?php
namespace xz1mefx\base\models\traits;

use yii\helpers\ArrayHelper;

/**
 * Class CategoryTreeTrait
 * @package xz1mefx\base\models\traits
 */
trait CategoryTreeTrait
{

    private static $_cachedItemsTree = NULL;
    private static $_cachedItemsTreeFlat = NULL;

    /**
     * @param bool $flat
     *
     * @return array|null
     */
    public static function getTreeItem($id, $resetCache = FALSE)
    {
        self::resetItemsIdTreeCache();
        $res = collectItemsIdTree(TRUE);
        return empty($res[$id]) ? NULL : $res[$id];
    }

    /**
     *
     */
    public static function resetItemsIdTreeCache()
    {
        self::$_cachedItemsTree = NULL;
        self::$_cachedItemsTreeFlat = NULL;
    }

    /**
     * @param bool $flat
     *
     * @return array|null
     */
    public static function collectItemsIdTree($flat = FALSE)
    {
        if (self::$_cachedItemsTree === NULL || self::$_cachedItemsTreeFlat === NULL) {
            $preparedData = ArrayHelper::map(
                self::find()
                    ->select([
                        self::tableName() . '.id',
                        self::tableName() . '.parent_id',
                    ])
                    ->asArray()
                    ->all(),
                'id',
                function ($element) {
                    /* @var self $element */
                    return [
                        'id' => (int)$element['id'],
                        'parent_id' => (int)$element['parent_id'],
                    ];
                },
                'parent_id'
            );
            self::$_cachedItemsTree = self::_collectItemsRecursive($preparedData, self::$_cachedItemsTreeFlat);
            unset($preparedData);
        }

        return $flat ? self::$_cachedItemsTreeFlat : self::$_cachedItemsTree;
    }

    /**
     * @param array $data
     * @param array $flatData
     * @param int   $parent_id
     * @param array $parentsList
     * @param int   $level
     *
     * @return array
     */
    private static function _collectItemsRecursive(&$data, &$flatData = [], $parent_id = 0, $parentsList = [], $level = 1)
    {
        $res = [
            'items' => [],
            'childs' => [],
        ];

        if (isset($data[$parent_id])) {
            foreach ($data[$parent_id] as $category) {
                $preparedParentsList = $parentsList;
                if ($parent_id > 0) {
                    $preparedParentsList[] = $category['parent_id'];
                }

                $recursiveData = self::_collectItemsRecursive($data, $flatData, $category['id'], $preparedParentsList, $level + 1);

                $flatData[$category['id']] = $res['items'][$category['id']] = [
                    'id' => $category['id'],
                    'parent_id' => $category['parent_id'],
                    'level' => $level,
                    'parents_id_list' => $preparedParentsList,
                    'children_id_list' => $recursiveData['childs'],
                ];
                $res['items'][$category['id']]['children_data_list'] = $recursiveData['items'];

                $res['childs'] = array_merge($res['childs'], $recursiveData['childs']);
                $res['childs'][] = $category['id'];
            }
        }

        return $parent_id == 0 ? $res['items'] : $res;
    }

}
