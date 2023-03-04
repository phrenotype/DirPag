<?php

namespace DirPag;

/**
 * Directory Paginator.
 */
class DirPag
{
    private static $LIMIT = 10;

    /**
     * Paginate a directory.
     * 
     * @param string $path Path to the directory.
     * @param int $page_number Page number.
     * 
     * @return Result
     */
    public static function page($path, $page_number)
    {
        if (is_string($path)) {
            if (file_exists($path) && is_readable($path)) {
                return DirPagUtils::paginate($path, $page_number);
            } else {
                throw new \Exception(sprintf("Directory '%s' does not exist or is not readable.", $path));
            }
        } else {
            throw new \Exception(sprintf("Exception: parameter '%s' passed to '%s' is not an iterable or string.", 'iterable', __METHOD__));
        }
    }

    /**
     * Search a directory and paginate the results.
     * 
     * @param string $regex_query A regular expression.
     * @param string $path Path to the directory.
     * @param int $page_number Page number.
     * 
     * @return Result
     */
    public static function search($regex_query, $path, $page_number)
    {
        if (is_string($path) && file_exists($path) && is_readable($path)) {
            return DirPagUtils::search($regex_query, $path, $page_number);
        } else {
            throw new \Exception(sprintf("Directory '%s' does not exist or is not readable.", $path));
        }
    }

    /**
     * Get or set the pagination limit (item per page). To get the value, call without the limit parameter.
     * 
     * @param int|null $limit Items per page. An integer.
     * 
     * @return int|null
     */
    public static function limit($limit = null)
    {
        if (is_null($limit)) {
            return static::$LIMIT;
        } else {
            if (is_int($limit)) {
                static::$LIMIT = $limit;
            } else {
                throw new \Exception(sprintf("Exception: parameter '%s' passed to '%s' is not an integer", 'limit', __METHOD__));
            }
        }
    }
}
