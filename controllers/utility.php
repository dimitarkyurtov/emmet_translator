<?php
    require_once("../models/tree.php");

    function tokenize_depth($str)
    {
        $size = strlen($str);
        $token = "";
        $tokens = array();
        $brackets = 0;

        for ($i=0; $i < $size; $i++) 
        { 
            if($str[$i] == '(')
            {
                $brackets ++;
            }

            if($str[$i] == ')')
            {
                $brackets --;
            }

            if($str[$i] == '>' && $brackets == 0)
            {
                array_push($tokens, $token);
                $token = "";
            }
            else
            {
                $token = $token . $str[$i];
            }
        }

        array_push($tokens, $token);

        return $tokens;
    }

    function array_to_tree_empty_root($array)
    {
        $size = count($array);

        $root = new htmlNode();
        $root->tag = "";
        $child = new htmlNode();
        $parent = new htmlNode();
        $parent = $root;

        for ($i=0; $i < $size; $i++) 
        { 
            $child = new htmlNode();
            $child->tag = $array[$i];
            $parent->add_child($child);
            $parent = $child;
        }

        

        return $root;
    }

    function array_to_tree($array)
    {
        $size = count($array);

        $root = new htmlNode();
        $root->tag = $array[0];
        $child = new htmlNode();
        $parent = new htmlNode();
        $parent = $root;

        for ($i=1; $i < $size; $i++) 
        { 
            $child = new htmlNode();
            $child->tag = $array[$i];
            $parent->add_child($child);
            $parent = $child;
        }

        

        return $root;
    }

    function print_tree_xml($root, $depth, $options)
    {
        $root->split_tag();
        $br = "&#13;";
        if($root->tag != "" && $root->tag != "content")
        {
            if(count($root->children) == 0)
            {
                $br = "";
            }
            else
            {
                $br = "&#13;";
            }
            $depth += 1;
            for ($i=0; $i < $depth; $i++) 
            { 
                echo "  ";
            }
            echo "&lt";
            if (count($root->namespaces) > 0 && $options['namespace'] == "true") 
            {
                foreach ($root->namespaces as $namespace)
                {
                    echo $namespace . ":";
                }
            }
            $root->tag = str_replace("@", " ", $root->tag);
            $root->tag = str_replace("?", " ", $root->tag);
            echo $root->tag;
            if($root->id && $options['id'] == "true")
            {
                echo " id=&quot" . $root->id . "&quot";
            }
            if(count($root->classes) > 0 && $options['class'] == "true")
            {
                echo " class=&quot";
                $lm = false;
                foreach ($root->classes as $class)
                {
                    if($lm)
                    {
                        echo " ";
                    }
                    $lm = true;
                    echo $class;
                }
                echo "&quot";
            } 
            
            if(strlen($root->custom_attributes) > 0 && $options['custom_attribute'] == "true")
            {
                echo " " . $root->custom_attributes; 
            } 
            echo "&gt" . $br;
        }

        if($root->content && $options['content'] == "true")
        {
            if($br)
            {
                for ($i=0; $i < $depth+1; $i++) 
                { 
                    echo "  ";
                }
            }
            $root->content = str_replace("@", " ", $root->content);
            $root->content = str_replace("?", " ", $root->content);
            echo $root->content . $br;
        }
        
        foreach ($root->children as $child) 
        {
            print_tree_xml($child, $depth, $options);
        }

        
        if($root->tag != "" && $root->tag != "content")
        {
            if(count($root->children) > 0)
            {
                for ($i=0; $i < $depth; $i++) 
                { 
                    echo "  ";
                }
            }
            echo "&lt/";
            if (count($root->namespaces) > 0 && $options['namespace'] == "true") 
            {
                foreach ($root->namespaces as $namespace)
                {
                    echo $namespace . ":";
                }
            }
            echo $root->tag . "&gt&#13;";
        }
    }

    function print_tree_emmet($root, $depth, $options)
    {
        $root->split_namespace();
        if(isset($options['lmao']) && $options['lmao'] == 'true')
        {
            $root->split_tag();
        }
        $size = count($root->children);
        if($root->tag != "")
        {
            if($size == 0)
            {
                $sym = "";
            }
            else
            {
                $sym = ">";
            }
            $depth += 1;
            if($root->tag == "content" && $options['content'] == "true")
            {
                $root->content = str_replace("@", " ", $root->content);
                $root->content = str_replace("?", " ", $root->content);
                echo $root->content . $sym;
            }
            else
            {
                if (count($root->namespaces) > 0 && $options['namespace'] == "true") 
                {
                    foreach ($root->namespaces as $namespace)
                    {
                        echo $namespace . ":";
                    }
                }
                $root->tag = str_replace("@", " ", $root->tag);
                $root->tag = str_replace("?", " ", $root->tag);
                echo $root->tag;
                if($root->id && $options['id'] == "true")
                {
                    echo "#" . $root->id;
                }
    
                
                if(count($root->classes) && $options['class'] == "true")
                {
                    foreach ($root->classes as $class) 
                    {
                        echo "." . $class;  
                    }
                }

                if($root->custom_attributes && $options['custom_attribute'] == "true")
                {
                    echo "[" . $root->custom_attributes . "]";
                }
                echo $sym;
            }
        }
        
        $sym = "+";
        $br = "";
        $br2 = "";
        if($size > 1)
        {
            $br = '(';
            $br2 = ')';
        }
        
        for ($i=0; $i < $size; $i++) 
        { 
            if($i == 0)
            {
                $sym = '';
            }
            else
            {
                $sym = '+';
            }
            if($root->children[$i]->tag == "content")
            {
                if($options['content'] == "false")
                {
                    continue;
                }   
                $br = '{';
                $br2 = '}';
            }
            else
            {  
                $br = '(';
                $br2 = ')';
            }

            if(count($root->children) == 1 && $root->children[$i]->tag != "content")
            {
                $br = '';
                $br2 = '';
            }

            if(!($root->children[$i]->tag == "" && count($root->children[$i]->children) == 0))
            {
                echo $sym . $br;
                print_tree_emmet($root->children[$i], $depth, $options);
                echo $br2;
            }
        }

    }
    
    function remove_brackets($root)
    {
        if(count($root->children) > 0)
        {
            $size = count($root->children);
            $child = new htmlNode();
            $newChildren = array();

            for ($i=0; $i < $size; $i++) 
            {
                $child = new htmlNode();
                
                if(strlen($root->children[$i]->tag) > 0 && $root->children[$i]->tag[0] == '(')
                {
                    $newTag = substr($root->children[$i]->tag, 1, -1);
                    $emmet_tokens = tokenize_depth($newTag);
                    $newChildRoot = array_to_tree_empty_root($emmet_tokens);
                    blooms($newChildRoot);
                    remove_multiplications($newChildRoot);
                    array_push($newChildren, $newChildRoot);
                    if(count($root->children[$i]->children) > 0)
                    {
                        for ($j=0; $j < count($root->children[$i]->children); $j++) 
                        { 
                            array_push($newChildren, $root->children[$i]->children[$j]);
                        }
                    }
                }
                else if(strlen($root->children[$i]->tag) > 0 && $root->children[$i]->tag[0] == '{')
                {
                    $newTag = substr($root->children[$i]->tag, 1, -1);
                    $child->tag = "content";
                    $child->content = $newTag;
                }
                else
                {
                    $child = $root->children[$i];
                }

                array_push($newChildren, $child);

            }

            $root->children = $newChildren;
        }

        
        $size = count($root->children);
        for ($i=0; $i < $size; $i++) 
        {
            remove_brackets($root->children[$i]);
        }
    }

    function remove_multiplications($root)
    {
        $child = new htmlNode();
        $size = count($root->children);
        $newChildrenTags = array();
        $newChildren = array();

        for ($i=0; $i < $size; $i++) 
        {
            $child = new htmlNode();
            $child = $root->children[$i];
            $str = $child->tag;

            if(strlen($str) > 2 && substr($str, -2, 1) == '*' && substr($str, -1, 1) >= '0' && substr($str, -1, 1) <= '9')
            {
                $num = intval(substr($str, -1, 1));
                for ($j=0; $j < $num; $j++) 
                { 
                    $child = new htmlNode();
                    $child->tag = substr($str, 0, -2);
                    $child->children = $root->children[$i]->children;
                    array_push($newChildren, $child);
                }
            }
            else
            {
                array_push($newChildren, $child);
            }
        }

        $root->children = $newChildren;

        $size = count($root->children);

        for ($i=0; $i < $size; $i++) 
        {
            remove_multiplications($root->children[$i]);
        }
    }

    function remove_spaces_newLines_emmet($str)
    {
        $flag = false;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '<' || $str[$i] == '[')
            {
                $flag = true;
            }
            if($str[$i] == '>' || $str[$i] == ']')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '{')
            {
                $flag = true;
            }
            if($str[$i] == '}')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        $pattern = '/\s*/m';
        $replace = '';
        
        $message= $str;
    
        $removedLinebaksAndWhitespace = preg_replace( $pattern, $replace,$message);

        return $removedLinebaksAndWhitespace;
    }

    function remove_spaces_newLines($str)
    {
        $flag = false;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '<' || $str[$i] == '[')
            {
                $flag = true;
            }
            if($str[$i] == '>' || $str[$i] == ']')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        $flag = false;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '{')
            {
                $flag = true;
            }
            if($str[$i] == '}')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        $pattern = '/\s*/m';
        $replace = '';
        
        $message= $str;
    
        $removedLinebaksAndWhitespace = preg_replace( $pattern, $replace,$message);

        return $removedLinebaksAndWhitespace;
    }

    function print_atr($root, $atr, $path)
    {
        $new_path = $path;
        if($root->tag && !$path)
        {
            $new_path = $root->tag;
        }
        else if($root->tag)
        {
            $new_path .= '.' . $root->tag;
        }
        if($atr == "id")
        {
            if($root->id)
            {
                echo $new_path . ' = ' . $root->id . '&#10;';
            }
        }
        else if($atr == "class")
        {
            for ($i=0; $i < count($root->classes); $i++) 
            {
                echo $new_path . ' = ' . $root->classes[$i] . '&#10;';
            }
        }

        
        for ($i=0; $i < count($root->children); $i++) 
        {
            print_atr($root->children[$i], $atr, $new_path); 
        }
    }

    function ignore_xml_header($str)
    {
        if(!$str)
        {
            return '';
        }

        $flag = false;


        if($str[0] == '<')
        {
            if($str[1] == '!' || $str[1] == '?')
            {
                $flag = true;
            }
        }

        $i = 0;
        while($flag)
        {
            if($str[$i] == '>')
            {
                $flag = false;
            }
            $str[$i] = ' ';
            $i ++;
        }

        return $str;
    }

    function remove_spaces_newLines_xml($str)
    {
        $flag = false;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '<' || $str[$i] == '[')
            {
                $flag = true;
            }
            if($str[$i] == '>' || $str[$i] == ']')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        $flag = false;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] == '{')
            {
                $flag = true;
            }
            if($str[$i] == '}')
            {
                $flag = false;
            }
            if($str[$i] == ' ' && $flag)
            {
                $str[$i] = '?';
            }
        }
        $flag = false;
        $flag2 = false;
        $flag3 = false;
        $ctr = 0;
        for ($i=0; $i < strlen($str); $i++)
        { 
            if($str[$i] != " " && $str[$i] != "\n" && $str[$i] != "\t")
            {
                $flag3 = true;
            }
            if($str[$i] == '>')
            {
                $flag = true;
                $flag3 = false;
            }
            if($str[$i] == '<')
            {
                $flag = false;
            }
            if($flag3 && $flag && $str[$i] == " ")
            {
                $str[$i] = '@';
            }
        }

        $flag = false;
        $flag2 = false;
        $flag3 = false;
        for ($i= strlen($str)-1; $i >= 0; $i--)
        { 
            if($str[$i] != "@" && $str[$i] != "\n" && $str[$i] != "\t")
            {
                $flag3 = true;
            }
            if($str[$i] == '<')
            {
                $flag = true;
                $flag3 = false;
            }
            if($str[$i] == '>')
            {
                $flag = false;
            }
            if(!$flag3 && $flag && $str[$i] == "@")
            {
                $str[$i] = ' ';
            }
        }

        $pattern = '/\s*/m';
        $replace = '';
        
        $message= $str;
    
        $removedLinebaksAndWhitespace = preg_replace( $pattern, $replace,$message);

        return $removedLinebaksAndWhitespace;
    }

    function xml_array_to_tree($array)
    {
        $size = count($array);
        $root = new htmlNode();
        $root->tag = "";
        $curr = new htmlNode();
        $child = new htmlNode();
        $curr = $root;
        /*
        $curr->tag = substr($array[0], 1);
        array_push($root->children, $curr);*/
        

        for ($i=0; $i < $size; $i++) 
        { 
            $temp = preg_replace('/\s+/', '', $array[$i]);
            $temp = remove_spaces_newLines($array[$i]);
            $content = str_replace("&nbsp;", "", $array[$i]);
            $content = html_entity_decode($content);
            if(strlen($content) == 0)
            {
                //echo "$i" . "&#13;";
                continue;
            }
            if(strlen($array[$i]) > 0)
            {
                if($array[$i][0] == '!' && $array[$i][1] != '/')
                {
                    $array[$i] = substr($array[$i], 1);
                    $child = new htmlNode();
                    
                    $pattern = "/\?/";
                    $temp = preg_split($pattern, $array[$i]);
                    if(count($temp) > 1)
                    {
                        $sym = "";
                        $custom = "";
                        for ($j=1; $j < count($temp); $j++) 
                        {
                            if(strpos($temp[$j],"id=")===false && strpos($temp[$j],"class=")===false && count(preg_split("/=/", $temp[$j])) > 1)
                            {
                                $custom .= $sym . $temp[$j];
                                $sym = " ";
                            }
                        }
                        $child->custom_attributes = $custom;
                    }
                    
                    $pattern = "/id=/";
                    $temp = preg_split($pattern, $array[$i]);
                    if(count($temp) > 1)
                    {
                        $temp_id_token = $temp[1];
                        $pattern = "/\?/";
                        $temp_id = preg_split($pattern, $temp_id_token);
                        $temp2 = $temp_id[0];
                        $temp2 = substr($temp2, 1,-1);
                        $child->id = $temp2;
                    }

                    
                    $pattern = "/class=/";
                    $temp = preg_split($pattern, $array[$i]);
                    if(count($temp) > 1)
                    {
                        $temp_id_token = $temp[1];
                        $pattern = "/\"/";
                        $temp_id = preg_split($pattern, $temp_id_token);
                        $temp2 = $temp_id[1];
                        $pattern = "/\?/";
                        $temp_id = preg_split($pattern, $temp2);
                        foreach ($temp_id as $class)
                        {
                            array_push($child->classes, $class);
                        }
                    }

                    $pattern = "/\?/";
                    $new_tag = preg_split($pattern, $array[$i]);
                    $child->tag = $new_tag[0];
                    $child->parent = $curr;
                    array_push($curr->children, $child);
                    $curr = $child;
                }
                else if($array[$i][0] == '!')
                {
                    $curr = $curr->parent;
                }
                else
                {   
                    $string = str_replace(' ', '', $array[$i]);

                    if(strlen($string) > 0)
                    {
                        $child = new htmlNode();
                        $child->tag = "content";
                        $child->content = $array[$i];
                        $child->parent = $curr;
                        array_push($curr->children, $child);
                    }
                }
            }
        }

        return $root;
    }


    function blooms($root)
    {
        $parent = new htmlNode();
        $child = new htmlNode();
        $parent = $root;
        $size = count($parent->children);
        $newChildrenTags = array();
        $newChildren = array();

        for ($i=0; $i < $size; $i++) 
        {
            $child = new htmlNode();
            $child = $parent->children[$i];
            $size2 = strlen($child->tag);
            $token = "";
            $newChildrenTags = array();
            $brackets = 0;
            $str = $child->tag;

            for ($j=0; $j < $size2; $j++) 
            { 
                if($str[$j] == '(')
                {
                    $brackets ++;
                }

                if($str[$j] == ')')
                {
                    $brackets --;
                }

                if($str[$j] == '+' && $brackets == 0)
                {
                    array_push($newChildrenTags, $token);
                    $token = "";
                }
                else
                {
                    $token = $token . $str[$j];
                }
            }

            array_push($newChildrenTags, $token);

            $size3 = count($newChildrenTags);

            $newChild = new htmlNode();

            for ($j=0; $j < $size3; $j++) 
            {
                $newChild = new htmlNode();
                $newChild->tag = $newChildrenTags[$j];

                if($j == $size3-1)
                {
                    if(count($child->children) > 0)
                    {
                        blooms($child);
                    }
                    $newChild->children = $child->children;
                }

                array_push($newChildren, $newChild);
            }
        }

        $root->children = $newChildren;
    }
?>