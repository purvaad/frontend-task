<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
    <title>percentage-calculator</title>
</head>
<body>
    <div class="container">
        <header class="title">
            <h1>Percentage Calculator</h1>
        </header>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?> ">
        Amount: <input class="amount" type="text" name="amount">
        <br><br>

        Interest (%): <input class="interest" type="text" name="interest">
        <br><br>

        <input class="submit" type="submit">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $amount = htmlspecialchars($_POST['amount']);
            $interest = htmlspecialchars($_POST['interest']);

            //function to calc percentage of interest on amount
            function calculatePercentage($amount, $interest ){
                if ($interest == 0){
                    return "Interest cannot be zero!";
                }
                return ($amount*$interest)/100;
            }

            if (empty($amount) || empty($interest)) {
                echo "Please enter amount and interest";
            } else {
                $percentage = calculatePercentage($amount, $interest);
                echo "Percentage result: " . $percentage;
            } 
            }
        ?>

    </div>



</body>
</html>