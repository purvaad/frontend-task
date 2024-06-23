<html>
<head>
    <title>php-array-exercise</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Pattern - 2</h1>
<?php 
    $num = 5;

    for($i=1; $i <= $num; $i++) {

        for($j= 1; $j <= $num-$i; $j++){
            echo "&nbsp;&nbsp;";
        }
        for($k = 1; $k <= $i; $k++){
            echo "*&nbsp;&nbsp;";
        }
        echo "<br>";
        
    }
?>
    
</body>
</html>