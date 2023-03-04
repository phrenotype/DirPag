<?php

namespace DirPag;

class Result
{
    private $values;
    private $total_count;
    private $last_page;

    public function __construct($values, $total_count, $last_page)
    {
        $this->values = $values;
        $this->total_count = $total_count;
        $this->last_page = $last_page;
    }

    public function values()
    {
        return $this->values;
    }

    public function total_count()
    {
        return $this->total_count;
    }

    public function last_page()
    {
        return $this->last_page;
    }

    public function __set($name, $value)
    {
        return false;
    }
}

