<?php

namespace DirPag;

/**
 * Utilities for DirPag.
 */
class DirPagUtils
{
    /**
     * Get a page from directory content.
     * 
     * @param string $path
     * @param int $page_number
     * 
     * @return Result
     */
    public static function paginate($path, $page_number)
    {
        $page = (int)$page_number;
        $offset = 0;
        $limit = DirPag::limit();

        $total_items = static::get_total_items_in($path);
        $last_page = ceil($total_items / $limit);

        if ($page > $last_page) {
            $page = $last_page;
        }

        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }

        $counter = 0;

        $return_values = [];

        static::for_each_file_in($path, function ($entry) use (&$counter, $limit, $offset, &$return_values) {

            if (count($return_values) >= $limit) {
                return;
            }

            if ($counter >= $offset) {
                $return_values[] = $entry;
            }

            $counter++;
        });

        $result = new Result($return_values, $total_items, $last_page);
        return $result;
    }

    /**
     * Search a directory and paginate the results.
     * 
     * @param string $regex_query
     * @param string $path
     * @param int $page_number
     * 
     * @return Result
     */
    public static function search($regex_query, $path, $page_number)
    {
        $page = (int)$page_number;
        $offset = 0;
        $limit = DirPag::limit();

        $total_items = static::get_total_items_in($path);
        $last_page = ceil($total_items / $limit);

        if ($page > $last_page) {
            $page = $last_page;
        }

        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }

        $counter = 0;

        $return_values = [];

        static::for_each_file_in($path, function ($entry) use (&$counter, $limit, $offset, &$return_values, $regex_query) {

            if (count($return_values) >= $limit) {
                return;
            }
            
            try{
                if ($counter >= $offset && preg_match($regex_query, $entry)) {
                    $return_values[] = $entry;
                }
            }catch(\Exception $e){
                sprintf("Invalid Regular Expression: %s", $e->getMessage());
            }


            $counter++;
        });

        $result = new Result($return_values, $total_items, $last_page);
        return $result;
    }

    /**
     * Get total item count in directory.
     * 
     * @param string $path
     * 
     * @return int
     */
    public static function get_total_items_in($path)
    {
        $counter = 0;
        static::for_each_file_in($path, function ($entry) use (&$counter) {
            $counter++;
        });
        return $counter;
    }

    /**
     * Run a function for each item in a directory.
     * 
     * @param string $directory
     * @param callable $function
     * 
     * @return void
     */
    public static function for_each_file_in($directory, $function)
    {
        if ($handle = opendir($directory)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $function($entry);
                }
            }
            closedir($handle);
        }
    }
}