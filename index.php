<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haystek Assessment</title>
    <style>
        body{
            background-color:#47afe7;
            font-family: system-ui;
            font-weight: 600;
        }
        section{            
            width: 500px;
            margin: auto;
        }
        .data-item{
            border-radius: 10px;
            display: flex;
            width: 500px;
            overflow: hidden;
            margin-bottom:10px;
        }
        .serial-number{
            background-color:#6dce8c;
            color:#fff;
            padding:10px;
            font-size:30px;
            width: 40px;
            text-align: center;
        }
        .data-content div{
            padding: 5px 10px;
        }
        .data-content{
            width: 100%;
        }
        .data-content .name{
            background-color:#d2e6f9;
            font-size:16px;
        }
        .data-content .location{
            background-color:#ffffff;
            font-size:16px;
        }
        button{
            border-radius:10px;
            background-color:#f49c63;
            color:#fff;
            border-color:#f49c63;
            padding:8px;
            float:right;
            font-family: system-ui;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <?php
        $Data = file_get_contents('data.json');
        $json = json_decode($Data, true);
    ?>
    <section>
        <h2>People Data
        <button class="" onclick="myFunction()">NEXT PERSON</button></h2>
    </section>
    <section class="content" id="content">

        <?php
            BuildPerson($json[0], 0);
            function BuildPerson($DataObj, $index){
                
                    $html = '<div class="data-item">
                                <div class="serial-number"> '.  ($index+1) .' </div>
                                <div class="data-content"> 
                                    <div class="name">Name: '. ($DataObj['name']) .'</div>
                                    <div class="location">Location: '.  ($DataObj['location']) .'</div>
                                </div>
                            </div>';

                    //libxml_use_internal_errors(true);
                    $doc = new DOMDocument(); 
                    $doc->loadHTML($html); 
                    echo $doc->saveHTML();
            }                 
        ?>       
    </section>

    <section style="text-align:center;">
        <h4 style="color:#fff;">CURRENTLY <span id="count">1</span> PEOPLE SHOWING </h4>
    </section>
            <script>
                var JsonObj = <?php echo ($Data); ?>;  

                var PersonCount = 1;
                function myFunction(){
                    if(JsonObj.length > PersonCount){
                        BuildContent(PersonCount);
                        PersonCount = PersonCount+1;
                    }else{
                        alert("No more people!");
                    }
                }
                
                function BuildContent(key){
                    var DataObj = JsonObj[key]

                    var HtmlCode  = '<div class="data-item">\
                                    <div class="serial-number"> '+  (parseInt(key)+1) +' </div>\
                                    <div class="data-content"> \
                                        <div class="name">Name: '+ (DataObj['name']) +'</div>\
                                        <div class="location">Location: '+  (DataObj['location']) +'</div>\
                                    </div>\
                                </div>';

                    document.getElementById("content").insertAdjacentHTML('beforeend', HtmlCode);
                    document.getElementById("count").innerText = PersonCount+1;  


                }

                
            </script>
   
    
</body>
</html>
