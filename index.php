<?php
	
        require __DIR__ .'/vendor/autoload.php';
        
        $output = new PatchFind\Calculate();
        
        $output->setStartXY(0,0);
        $output->setEndXY(99,99);
        $graph = $output->makeGraph(100,100);


	
	
	
	
	
