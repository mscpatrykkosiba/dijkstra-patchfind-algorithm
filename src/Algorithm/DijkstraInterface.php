<?php

    namespace PatchFind\Algorithm;
    
    interface DijkstraInterface
    {
        /**
         * calculate road in graph
         *
         * @param  int   $startX
         * @param  int   $startY
         * @param  int   $endX
         * @param  int   $endY
         * @param  array $graph
         * @return array
         */
        public function calculateRoad($startX, $startY, $endX, $endY, $graph);
        
    }
