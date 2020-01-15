<?php
	
    namespace PatchFind;

    interface CalculateInterface
    {
        /**
         * initial starting position
         *
         * @param  int  $x
         * @param  int  $y
         * @return bool
         */
        public function setStartXY($x, $y);

        /**
         * initial ending position
         *
         * @param  int  $x
         * @param  int  $y
         * @return bool
         */
        public function setEndXY($x, $y);

        /**
         * define graph size and prepare structure
         *
         * @param  int $width
         * @param  int $height
         * @return array
         */
        public function makeGraph($width, $height);

        /**
         * loading obstacle map
         *
         * @param  string $map
         * @return array
         * @throws Exception\InvalidArgumentException
         */
        public function loadGraph($map);

        /**
         * calculation of the shortest route
         *
         * @param  array $graph
         * @return array
         */
        public function getPatch($graph);

        /**
         * render the shortest route preview
         *
         * @param  string  $file
         * @param  array   $patch
         * @return string
         */
        public function renderPatch($file, $patch);
    }
