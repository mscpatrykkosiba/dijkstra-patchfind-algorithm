dijkstra-patchfind-algorithm
======================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mscpatrykkosiba/dijkstra-patchfind-algorithm/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mscpatrykkosiba/dijkstra-patchfind-algorithm/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/mscpatrykkosiba/dijkstra-patchfind-algorithm/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mscpatrykkosiba/dijkstra-patchfind-algorithm/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mscpatrykkosiba/dijkstra-patchfind-algorithm/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

PHP patchfind algorithm in (X,Y) coords weight graph.

## How to use

The maximum position in the graph and image size is 1000x1000 [px]. Can be changed in the code.

First, enter the coordinates of the start and end points in the graph. The coordinates cannot be larger than the size of the declared or loaded from the graph file.

In order to add obstacles on the route of the calculated route, it is necessary to load the graphics from the .jpg file. White background corresponds to free space, dark obstacle.

The algorithm returns the route to be taken in the form of points (x, y) and allows you to generate a route in the preview image.


```php
<?php
	
    require __DIR__ .'/vendor/autoload.php';
        
    $output = new PatchFind\Calculate();
        
    //set start and finish position
    
    $output->setStartXY(0,0);
    $output->setEndXY(100,100);
        
    //calculate patch in blank graph
    
    $graph = $output->makeGraph(100,100);
    $patch = $output->getPatch($graph);
    var_dump($patch);
    /*
     var_dump($patch) returns:
     ex. (0,0),(0,1)(1,1),(1,2)
     ..array
     */    
     
    //calculate patch in obstacle graph
    
    $graph = $output->loadGraph(__DIR__."/test.jpg");
    $patch = $output->getPatch($graph);
    var_dump($patch);
    /*
     var_dump($patch) returns:
     ex. (0,0),(0,1)(1,1),(1,2)
     ..array
     */   
     
```

Render preview image

```php
<?php

    //render patch image
    
    $image_url = $output->renderPatch(__DIR__.'/test.jpg', $patch);
    
```
![blank graph preview](http://websolutions.com.pl/graph_blank.png)

## Requirements

* PHP version 5.5 or later
* PHP GB Library
* PHPUnit for tests (optional)

## Installation

This library depends on composer for installation . For installation of composer, please visit [getcomposer.org](//getcomposer.org).
You can download .zip for compile composer.json file to create vendor directory.

## Authors

MSc Patryk Kosiba
See profile on linkedin (https://www.linkedin.com/in/patryk-kosiba/)

## License

This project is licensed under the MIT License.
