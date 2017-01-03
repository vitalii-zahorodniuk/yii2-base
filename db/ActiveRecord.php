<?php
namespace xz1mefx\base\db;

use Yii;

/**
 * Class ActiveRecord
 * @package xz1mefx\base\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * Lock DB tables
     *
     * @param null|string|array $table     Examples:
     *                                     'table_name'
     *                                     or 'table_name tn'
     *                                     or ['table_name_1 tn1', 'table_name_2', 'tn3'=>'table_name_3']
     * @param string            $blockType 'WRITE'|'READ'
     */
    public static function lockTables($table = NULL, $blockType = 'WRITE')
    {
        $sql = "LOCK TABLES ";
        if ($table === NULL) {
            $sql .= self::tableName() . " $blockType";
        } else {
            $tmpSql = '';
            foreach ((is_array($table) ? $table : [$table]) as $key => $value) {
                $tmpSql .= empty($tmpSql) ? '' : ', ';
                $tmpSql .= "$value";
                $tmpSql .= is_string($key) ? " $key" : '';
                $tmpSql .= " $blockType";
            }
            $sql .= $tmpSql;
        }
//        die(Yii::$app->db->createCommand($sql)->rawSql);
        Yii::$app->db->createCommand($sql)->query();
    }

    /**
     * Unlock DB tables
     */
    public static function unlockTables()
    {
        Yii::$app->db->createCommand("UNLOCK TABLES;")->query();
    }

}
