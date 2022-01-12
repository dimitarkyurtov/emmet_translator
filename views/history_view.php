<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/history.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/ajax.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="r">
        <div class="s">
        <input class="lim" type="number" id="limit" name="limit" placeholder="Limit">

        <input type="checkbox" id="emmet" name="emmet" value="emmet">
        <label class="w" for="emmet">emmet</label>
            
        <input type="checkbox" id="xml" name="xml" value="xml">
        <label class="w" for="xml">xml</label>

        <button type="submit" onclick="search()"> Search </button>
        </div>
    </div>
    <div class="center">
        <p class="inner" id="queries"></p>
    </div>
</body>
</html>