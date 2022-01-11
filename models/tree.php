<?php
    class htmlNode {
        public $tag;
        public $children;
        public $parent;
        public $id;
        public $classes;
        public $content;
        public $namespaces;
        public $custom_attributes;

        public function __construct()
        {
            $this->tag = "";
            $this->children = array();
            $this->classes = array();
            $this->namespaces = array();
        }

        public function add_child($child)
        {
            array_push($this->children, $child);
        }

        public function split_namespace()
        {
            $temp = explode(":", $this->tag);    
            if(count($temp) > 1)
            {
                for ($i=0; $i < count($temp)-1; $i++) 
                {
                    array_push($this->namespaces, $temp[$i]);
                }
            }
            $this->tag = $temp[count($temp)-1];
        }

        public function split_tag()
        {
            $temp = explode("#", $this->tag);
            if(count($temp) > 1)
            {
                $temp2 = explode(".", $temp[1]);
                $temp3 = explode("{", $temp2[0]);
                $temp4 = explode("[", $temp3[0]);
                $this->id = $temp4[0];
            }

            $temp = explode(".", $this->tag);
            $size = count($temp);
            for ($i=1; $i < $size; $i++) 
            {
                $temp2 = explode("#", $temp[$i]);
                $temp3 = explode("{", $temp2[0]);
                $temp4 = explode("[", $temp3[0]);
                array_push($this->classes, $temp4[0]);
            }

            $temp = explode("{", $this->tag);    
            if(count($temp) > 1)
            {
                $temp2 = explode("}", $temp[1]);
                $this->content = $temp2[0];
            }

            $temp = explode("[", $this->tag);
            $size = count($temp);
            $sym = " ";
            for ($i=1; $i < $size; $i++) 
            {
                $temp4 = explode("]", $temp[$i]);
                if($i == $size-1)
                {
                    $sym = "";
                }
                $this->custom_attributes .= $temp4[0] . $sym;
            }
            
            $pattern = "/([\s[\s.\s#\s{])/";
            $components = preg_split($pattern, $this->tag, -1);
            $this->tag = $components[0];

            $this->split_namespace();
        }
    }
?>