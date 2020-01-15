<?php

    namespace PatchFind\Graph;
    
    class Generate implements GenerateInterface{
        
        /**
         * width of graph
         * @var int
         */
        private $x_w;
        
        /**
         * height of graph
         * @var int
         */
        private $y_h;
        
        /**
         * create final graph
         *
         * @param  int    $width
         * @param  int    $height
         * @return array
         */
        public function createGraph($width, $height){
            $this->x_w = $width;
            $this->y_h = $height;
            
            $modX = ceil($width/2);
            $modY = ceil($height/2);

            $relations = array();
            for($y = 0; $y <= $height; $y++){
                for($x = 0; $x <= $width; $x++){
                    $k = $x; $k2 = $y;
                    if($x<$modX) $k = $width-$x;
                    if($y<$modY) $k2 = $height-$y;
                    $k3 = $k;
                    if($k2>$k) $k3 = $k2;
                  
                    $tmpX = $x-1; $tmpY = $y;
                    if($this->checkParams($tmpX, $tmpY)) $relations["($tmpX,$tmpY)"]["($x,$y)"] = $k3;
                   
                    $tmpX2 = $x+1; $tmpY2 = $y;
                    if($this->checkParams($tmpX2, $tmpY2)) $relations["($tmpX2,$tmpY2)"]["($x,$y)"] = $k3;

                    $tmpX3 = $x; $tmpY3 = $y-1;
                    if($this->checkParams($tmpX3, $tmpY3)) $relations["($tmpX3,$tmpY3)"]["($x,$y)"] = $k3;
                    
                    $tmpX4 = $x; $tmpY4 = $y+1;
                    if($this->checkParams($tmpX4, $tmpY4)) $relations["($tmpX4,$tmpY4)"]["($x,$y)"] = $k3;
                }
            }
            
            return $relations;
        }
        
        /**
         * load graph from .jpg file
         *
         * @param  string $file
         * @return array
         */
        public function loadFromFile($file){
            
            $res = @imagecreatefromjpeg($file);
            $relations = array();
            
            if(!$res){
                $width = imagesx($res);
                $height = imagesy($res);

                $new_tab = array();
                for($y = 0; $y <= $height; $y++){
                    for($x = 0; $x <= $width; $x++){
                        if($y==$height || $x==$width){
                            $color = 10;
                        }else{
                            $color = imagecolorat($res, $x, $y);
                            if(!$color) $color = 255;
                        }
                        $new_tab[$x][$y] = $color;
                    }
                } 

                $this->x_w = $width;
                $this->y_h = $height;

                $modX = ceil($width/2);
                $modY = ceil($height/2);

                for($y = 0; $y <= $height; $y++){
                    for($x = 0; $x <= $width; $x++){

                        if($new_tab[$x][$y]<=100){
                           $k3 = 9999; 
                        }else{
                            $k = $x; $k2 = $y;
                            if($x<$modX) $k = $width-$x;
                            if($y<$modY) $k2 = $height-$y;
                            $k3 = $k;
                            if($k2>$k) $k3 = $k2;
                        }
                        $tmpX = $x-1; $tmpY = $y;
                        if($this->checkParams($tmpX, $tmpY)) $relations["($tmpX,$tmpY)"]["($x,$y)"] = $k3;

                        $tmpX2 = $x+1; $tmpY2 = $y;
                        if($this->checkParams($tmpX2, $tmpY2)) $relations["($tmpX2,$tmpY2)"]["($x,$y)"] = $k3;

                        $tmpX3 = $x; $tmpY3 = $y-1;
                        if($this->checkParams($tmpX3, $tmpY3)) $relations["($tmpX3,$tmpY3)"]["($x,$y)"] = $k3;

                        $tmpX4 = $x; $tmpY4 = $y+1;
                        if($this->checkParams($tmpX4, $tmpY4)) $relations["($tmpX4,$tmpY4)"]["($x,$y)"] = $k3;
                    }
                }
            }
            
            return $relations;
        }
        
        /**
         * check input params
         *
         * @param  int $width
         * @param  int $height
         * @param  int $tmpX
         * @param  int $tmpY
         * @return bool
         */
        private function checkParams($tmpX, $tmpY){
            if($tmpX >= 0 && $tmpY >= 0 && $tmpX <= $this->x_w && $tmpY <= $this->y_h){
                $output = true;
            }else{
                $output = false;
            }
            
            return $output;
        }
        
    }
