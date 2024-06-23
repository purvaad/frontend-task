<html>
<head>
    <title>php-array-exercise</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Pattern 1</h1>
<?php 

    for($i=0; $i<=7; $i++) {
        for($j=0; $j<=$i; $j++){
            echo "*";
        }
        echo "<br>";
    }
?>
    
</body>
</html>