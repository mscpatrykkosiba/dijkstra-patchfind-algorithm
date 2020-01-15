<?php

    namespace PatchFind;
    
    use PatchFind\Graph\Generate;
    use PatchFind\Algorithm\Dijkstra;
    
    class Calculate implements CalculateInterface
    {
        /**
         * start x position
         * @var int
         */
        public $startX;
        
        /**
         * start y position
         * @var int
         */
        public $startY;
        
        /**
         * end x position
         * @var int
         */
        public $endX;
        
        /**
         * end y position
         * @var int
         */
        public $endY;
        
        /**
         * initial starting position
         *
         * @param  string $x
         * @param  string $y
         * @return bool
         * @throws Exception\InvalidArgumentException
         */
        public function setStartXY($x, $y){
            if(self::validateInput($x) && self::validateInput($y)){
                $this->startX = $x;
                $this->startY = $y;
            }else{
                throw new Exception\InvalidArgumentException('Invalid input data. All value should be an INT, from 0 to 1000');
            }
            
            return true;
        }
        
        /**
         * initial ending position
         *
         * @param  string $x
         * @param  string $y
         * @return bool
         * @throws Exception\InvalidArgumentException
         */
        public function setEndXY($x, $y){
            if(self::validateInput($x) && self::validateInput($y)){
                $this->endX = $x;
                $this->endY = $y;
            }else{
                throw new Exception\InvalidArgumentException('Invalid input data. All value should be an INT, from 0 to 1000');
            }
            
            return true;
        }
        
        /**
         * define graph size and prepare structure
         *
         * @param  int $width
         * @param  int $height
         * @return array
         */
        public function makeGraph($width, $height){
            $w = $this->check($width, 'x');
            $h = $this->check($height, 'y');
            
            $graph = new Generate();
            $output = $graph->createGraph($w, $h);
            
            return $output;
        }
        
        /**
         * loading obstacle map
         *
         * @param  string $map
         * @return array
         * @throws Exception\InvalidArgumentException
         */
        public function loadGraph($map){
            $graph = new Generate();
            if(mime_content_type($map)=="image/jpeg"){
                $output = $graph->loadFromFile($map);
            }else{
                throw new Exception\InvalidArgumentException('This is not .jpg file!');
            }
            return $output;
        }
        
        /**
         * calculation of the shortest route
         *
         * @param  array $graph
         * @return array
         */
        public function getPatch($graph){
            $calculate = new Dijkstra();
            
            $output = $calculate->calculateRoad($this->startX, $this->startY, $this->endX, $this->endY, $graph);
            
            return $output;
        }
        
        /**
         * render the shortest route preview
         *
         * @param  array  $file
         * @param  string $patch
         * @return string
         */
        public function renderPatch($file, $patch){
            $im = imagecreatefromjpeg($file);

            $red = imagecolorallocatealpha($im, 255, 0, 0, 0); 
            foreach ($patch as $key => $value){
                    $value2 = substr($value, 0, -1);
                    $value3 = substr($value2, 1); 
                    $exp = explode(",",$value3);
                    $pX = $exp[0];
                    $pY = $exp[1];

                    imagefill($im, $pX, $pY, $red);

            }

            imagejpeg($im);
            imagedestroy($im);
            
            return $file;
        }
        
        /**
         * check graph size with end position
         *
         * @param  int    $value
         * @param  string $type
         * @return int
         * @throws Exception\InvalidArgumentException
         */
        protected function check($value, $type){
            switch($type):
                case 'x':
                    if($this->endX>$value || self::validateInput($value)===false){
                        throw new Exception\InvalidArgumentException('Invalid value or type of graph width');
                    }
                    break;
                case 'y':
                    if($this->endY>$value || self::validateInput($value)===false){
                        throw new Exception\InvalidArgumentException('Invalid value or type of graph height');
                    }
                    break;
            endswitch;
           
            return $value;
        }
        
        /**
         * validate input value
         *
         * @param  int  $value
         * @return bool
         */
        protected static function validateInput($value){
            if(!is_int($value) || $value<0 || $value>1000){
                $output = false;
            }else{
                $output = true;
            }
            
            return $output;
        }

    }

