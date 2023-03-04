<?php

use DirPag\DirPagUtils;
use PHPUnit\Framework\TestCase;


class DirPagUtilsTest extends TestCase{

    protected function setUp(): void
    {
        $this->sample_directory = __DIR__ . '/SampleDirectory';
    }
    
    public function testForEachFileIn(){

        $entries = [];

        DirPagUtils::for_each_file_in($this->sample_directory, function($entry) use (&$entries){
            $entries[] = $entry;
        });

        $this->assertEquals(6, count($entries));
    }


    public function testTotalItemsIn(){
        $count = DirPagUtils::get_total_items_in($this->sample_directory);
        $this->assertEquals(6, $count);
    }
}