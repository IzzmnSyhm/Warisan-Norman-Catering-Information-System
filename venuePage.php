<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['cus_name'])) {
    header("Location: loginPage.php");
    exit();
}

$fullName = $_SESSION['cus_name'];
$nameParts = explode(" ", $fullName);
$firstName = $nameParts[0];

$sql = "SELECT * FROM venue";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<html>
    <head>
        <link rel="stylesheet" href="venuePageStyle.css">
    </head>

    <body class="homeBg">

        <?php include 'components/navbar/navbar.php'; ?>

        <div class="bHeader">
            <p>OUR</p>
            <h2>VENUE SELECTION</h2>
        </div>

        <div class="venue-container">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="form-card vertical">';
                    echo '<div class="card-img-wrap"><img src="bgImage.jpg"></div>';

                    echo '<div class="card-body">';
                    echo '<h2>' . strtoupper($row['VENUE_NAME']) . '</h2>';

                    echo '<p class="tagline">Beautiful Scenery</p>';
                    echo '<p class="info-line">📍 ' . $row['VENUE_LOCATION'] . '</p>';
                    echo '<p class="info-line">👥 Up to ' . $row['VENUE_CAPACITY'] . ' pax</p>';
                    echo '</div>';

                    echo '</div>';
                }
            } else {
                echo '<div class="form-card vertical">';
                echo '<div class="card-img-wrap"><img src="bgImage.jpg"></div>';
                echo '<div class="card-body">';
                echo '<h2>No venues available.</h2>';
                echo '<p class="info-line">Please check again later.</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>
    </body>
</html>