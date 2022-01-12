<?php
    require_once("../models/tree.php");
    require_once("utility.php");

    $emmet = $_GET['code'];
    $config = $_GET['config'];
    
    $emmet = remove_spaces_newLines($emmet);

    $emmet_tokens = tokenize_depth($emmet);
    $root = array_to_tree_empty_root($emmet_tokens);
    blooms($root);
    remove_multiplications($root);
    remove_brackets($root);
    print_tree_xml($root, -1, $config);
?>