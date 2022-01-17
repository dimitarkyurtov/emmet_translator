function interpretate(type){

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
    if (typeof $config['comment'] === 'undefined') 
    {
        $config['comment'] = "false";
    }
    if (typeof $config['comment_delim'] === 'undefined') 
    {
        $config['comment_delim'] = "false";
    }
    if (typeof $config['input_format'] === 'undefined') 
    {
        $config['input_format'] = "false";
    }
    if (typeof $config['output_format'] === 'undefined') 
    {
        $config['output_format'] = "false";
    }
    if (typeof $config['config_url'] === 'undefined') 
    {
        $config['config_url'] = "false";
    }
    if (typeof $config['data_url'] === 'undefined') 
    {
        $config['data_url'] = "false";
    }
    if (typeof $config['ouput_result'] === 'undefined') 
    {
        $config['ouput_result'] = "false";
    }
    if (typeof $config['callback_url'] === 'undefined') 
    {
        $config['callback_url'] = "false";
    }

    if($config['history'] === "true" || $config['history'] === true)
    {
        save(type);
    }
        
    $str = document.getElementById(type).value;


    
    if($config['input_format'] != "false")
    {
        type = $config['input_format'];
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

    if($config['output_format'] != "false")
    {
        out = $config['input_format'];

        if(out == 'xml')
        {
            $p_id = "decoded_2";
        }
        else if(out == 'emmet')
        {
            $p_id = "decoded";
        }
    }

    if($config['config_url'] != "false")
    {
        $.ajax({
            url: $config['config_url'],
            type: "GET",
            async: false,
            success: function(data){
                document.getElementById('config').innerHTML = data;
            }
        });
    }

    if($config['data_url'] != "false")
    {
        $.ajax({
            url: $config['data_url'],
            type: "GET",
            async: false,
            success: function(data){
                document.getElementById(type).innerHTML = data;
            }
        });
    }

    $.ajax({
        url: $url,
        type: "GET",
        data: {
            code: $str,
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
            document.getElementById("save_" + typee).style.visibility = "visible";
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