function interpretate(str, type){
    console.log(str);

    str = str.replace(/&nbsp;/, '');
    str = str.replace(/\t/, '');

    $json = document.getElementById("config").value;
    $config = {};
    if($json)
    {
        $config = JSON.parse($json);
    }
    if (typeof $config['id'] === 'undefined') 
    {
        $config['id'] = "false";
    }
    if (typeof $config['class'] === 'undefined') 
    {
        $config['class'] = "false";
    }
    if (typeof $config['content'] === 'undefined') 
    {
        $config['content'] = "false";
    }
    if (typeof $config['custom_attribute'] === 'undefined') 
    {
        $config['custom_attribute'] = "false";
    }
    if (typeof $config['history'] === 'undefined') 
    {
        $config['history'] = "false";
    }
    if (typeof $config['namespace'] === 'undefined') 
    {
        $config['namespace'] = "false";
    }

    if($config['history'] === "true" || $config['history'] === true)
    {
        save(type);
    }
    
        
    if(type == 'xml')
    {
        $url = '../controllers/xml_to_emmet.php';
        $p_id = "decoded_2";
    }
    else if(type == 'emmet')
    {
        $url = '../controllers/emmet_to_xml.php';
        $p_id = "decoded";
    }

    $.ajax({
        url: $url,
        type: "GET",
        data: {
            code: str,
            config: $config
        },
        success: function(data){
            document.getElementById($p_id).innerHTML = data;
        }
    });
}

function save(typee){
    $xml = document.getElementById(typee).value;
    $config = document.getElementById("config").value;
    $.ajax({
        url:'../controllers/persist_query.php',
        type: "Post",
        data: {
            code: $xml,
            type: typee,
            config: $config
        },
        success: function(data){
            document.getElementById("save_" + typee).innerHTML = data;
        }
    });
}

function search(){
    $xml = document.getElementById("xml");
    $emmet = document.getElementById("emmet");
    $limit = document.getElementById("limit").value;


    $.ajax({
        url:'../controllers/history.php',
        type: "Get",
        data: {
            limit: $limit,
            xml: $xml.checked,
            emmet: $emmet.checked
        },
        success: function(data){
            document.getElementById("queries").innerHTML = data;
        }
    });
}