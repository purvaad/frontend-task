<html>
<head>

    <title>php-array-exercise</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Country and their Capitals</h1>
<?php 
    $cnc = array(
        "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", 
        "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", 
        "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", 
        "Greece" => "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", 
        "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", 
        "United Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", 
        "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", 
        "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw"
);

        //for sort the list by capital of country in ascending order(asort)
        asort($cnc);
        echo "<ul>";
        //iterate through array and echo the country and its capital
        foreach ($cnc as $country => $capital) {
            echo "<li>The capital of $country is $capital. </li>";
        }
        echo "</ul>";
?>
    
</body>
</html>




