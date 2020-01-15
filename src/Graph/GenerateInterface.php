<?php

    namespace PatchFind\Graph;
    
    interface GenerateInterface
    {
        /**
         * create final graph
         *
         * @param  int    $width
         * @param  int    $height
         * @return array
         */
        public function createGraph($width, $height);
        
                
        /**
         * load graph from .jpg file
         *
         * @param  string $file
         * @return array
         */
        public function loadFromFile($file);
    }