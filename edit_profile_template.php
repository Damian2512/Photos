<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";

    // loop through the user records
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        // display user detail
        echo "<tr>";
		echo "<th>Firstname</th>";
        echo "<td>{$firstname}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Lastname</th>";
        echo "<td>{$lastname}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Email</th>";
        echo "<td>{$email}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Contact Number</th>";
        echo "<td>{$contact_number}</td>";
        echo "</tr>";
    }

    echo "</table>";

    $page_url="editprofile.php?";
    $total_rows = $user->countUser();

}

// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No users found.</strong>
    </div>";
}
?>