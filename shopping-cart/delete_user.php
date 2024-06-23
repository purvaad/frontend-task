<?php
@include ('./database.php');

// Delete Profile function
if(isset($_POST['delete_profile'])){
    // Perform deletion of the users account
    mysqli_query($con, "DELETE FROM users WHERE username='$username'");
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<style>
.button{
    height: 40px;
    width: 100%;
    color: #EEEEEE;
    font-size: 18px;
    font-weight: 400;
    margin-top: 10px;
    border: none;
    cursor: pointer;
    background: #31363F;
    transition: all 0.1s ease;
    border-radius: 6px;
}
    </style>
<body>
    <form id="deleteForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <!-- Delete Profile button -->
            <button class="button" type="button" onclick="confirmDelete()">Delete Profile</button>
        </div>
        <input type="hidden" name="delete_profile">
    </form>

    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete the profile?");
            if (result) {
                // If user confirms, submit the form for profile deletion
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</body>
</html>
