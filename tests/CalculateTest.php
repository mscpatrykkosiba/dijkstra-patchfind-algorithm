<?php

namespace PatchFindTest;

use PatchFind\Graph\Generate;
use PatchFind\Algorithm\Dijkstra;
use PHPUnit\Framework\TestCase;

class CalculateTest extends TestCase
{
    public function testValidateStartPosition()
    {
        $value = new Calculate();
        
        $this->assertTrue($value->setStartXY(0,0));
        $this->assertTrue($value->setStartXY(10,10));
        $this->assertFalse($value->setStartXY(-4,0));
        $this->assertFalse($value->setStartXY(9999,0));
    }
    
    public function testValidateEndPosition()
    {
        $value = new Calculate();
        
        $this->assertTrue($value->setEndXY(0,0));
        $this->assertTrue($value->setEndXY(10,10));
        $this->assertFalse($value->setEndXY(-4,0));
        $this->assertFalse($value->setEndXY(9999,0));
    }
    
    public function testGraphGeneratorTest()
    {
        $value = new Calculate();
        
        $this->assertIsArray($value->makeGraph(100,100));
    }
    
    public function testGraphLoadTest()
    {
        $valie = new Calculate();
        
        $this->assertIsArray($value->loadGraph(__DIR__."/test.jpg"));
    }
    
    public function testGetPatch()
    {
        $value = new Calculate();
        $graph = $value->makeGraph(100,100);
       
        $this->assertIsArray($value->getPatch($graph));
    }
}