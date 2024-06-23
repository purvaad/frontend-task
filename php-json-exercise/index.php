<html>
<head>
    <title>php-json-exercise</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Student's Information</h1>
    <table>
	<tr>
		<td class="title"><b>Name</b></td>
		<td class="title"><b>Age</b></td>
		<td class="title"><b>School</b></td>
	</tr>
	<?php
	$student_info = '[
        {
        "name" : "Ayush Singh",
        "age"  : "22",
        "school" : "Dehradoon Public school"
        },
        {
        "name" : "Smith Patel",
        "age"  : "18",
        "school" : "St. Xaviour school"
        },
        {
        "name" : "Rena Pamar",
        "age"  : "12",
        "school" : "Delhi Public school"
        }
    ]';
	$info = json_decode($student_info, true);
	foreach($info as $student) {
	?>
	<tr class="info">
		<td><?php echo $student['name']; ?></td>
		<td><?php echo $student['age']; ?></td>
		<td><?php echo $student['school']; ?></td>
	</tr>
	<?php	
		}
	?>
	</table>

    
</body>
</html>