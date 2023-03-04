<?php

use DirPag\DirPag;
use PHPUnit\Framework\TestCase;

class DirPagTest extends TestCase
{
    protected function setUp(): void
    {
        $this->sample_directory = __DIR__ . '/SampleDirectory';
    }

    public function testSearch()
    {
        //Increase the limit to get everything in one go
        DirPag::limit(100);
        $page = DirPag::search("/index/", $this->sample_directory, 1);

        $this->assertEquals(count($page->values()), 2);
    }

    public function testSearchRegex()
    {
        //Increase the limit to get everything in one go
        DirPag::limit(100);
        $page = DirPag::search("/.*\.php/", $this->sample_directory, 1);

        $this->assertEquals(count($page->values()), 1);
    }

    public function testPage()
    {
        //Increase the limit to get everything in one go
        DirPag::limit(100);
        $page = DirPag::page($this->sample_directory, 1);

        $this->assertEquals(count($page->values()), 6);
    }
}
