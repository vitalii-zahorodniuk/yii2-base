<?php
namespace xz1mefx\base\helpers;

/**
 * Class Url
 * @package xz1mefx\base\helpers
 */
class Url extends \yii\helpers\Url
{

    /**
     * Try to remove URL segment
     *
     * @param string $url         Subject URL
     * @param string $segment     Search segment
     * @param string $replacement Replacement string
     *
     * @return string Results URL
     */
    public static function removeUrlSegment($url, $segment, $replacement = '/')
    {
        $preparedSegment = trim($segment, '/');
        if (empty($preparedSegment)) {
            return $url;
        }
        preg_match('/^([^?]+?)(\?.+?)?$/', $url, $matches); // get url and get apart
        return preg_replace(
                '/(?:\/|^)' . $preparedSegment . '(?:\/|$)/i',
                $replacement,
                (isset($matches[1]) ? $matches[1] : '')
            ) . (isset($matches[2]) ? $matches[2] : '');
    }

}
