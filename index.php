<?php
	
        require __DIR__ .'/vendor/autoload.php';
        
        $output = new PatchFind\Calculate();
        
        //set start position
        $output->setStartXY(0,0);
        
        //set finish position
        $output->setEndXY(99,99);
        
        //create graph
        $graph = $output->makeGraph(100,100);


	
	
	
	
	
