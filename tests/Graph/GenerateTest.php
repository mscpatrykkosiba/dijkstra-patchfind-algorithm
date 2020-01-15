<?php

namespace PatchFindTest\Graph;

use PatchFind\Graph\Generate;
use PHPUnit\Framework\TestCase;

class GenerateTest extends TestCase
{
    public function testGraphGenerator()
    {
        $value = new Generate();
        
        $this->assertFalse($value->createGraph(0,0));
        $this->assertTrue($value->createGraph(10,10));
        $this->assertFalse($value->createGraph(-40,10));
    }
    
}