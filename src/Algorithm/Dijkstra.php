<?php

    namespace PatchFind\Algorithm;
    
    class Dijkstra implements DijkstraInterface
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
        public function calculateRoad($startX, $startY, $endX, $endY, $graph){
            $a = "(".$startX.",".$endX.")";
            $b = "(".$startY.",".$endY.")";
            
            $short = array(); 
            $query = array();
            foreach(array_keys($graph) as $v) $query[$v] = 99999;
            $query[$a] = 0;

            while(!empty($query)){
                $min = array_search(min($query), $query);
                if($min === $b) break;
                foreach($graph[$min] as $key => $v){
                    if(!empty($query[$key]) && $query[$min] + $v < $query[$key]){
                        $query[$key] = $query[$min] + $v;
                        $short[$key] = array($min, $query[$key]);
                    }
                }
                unset($query[$min]);
            }

            $path = array();
            $pos = $b;
            while($pos != $a){
                $path[] = $pos;
                $pos = $short[$pos][0];
            }
            $path[] = $a;
            $path = array_reverse($path);

            return $path;
        }
    }