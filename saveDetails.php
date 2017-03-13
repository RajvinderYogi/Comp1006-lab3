<?php
$pageTitle = 'Details saved';
require_once ('header.php'); ?>

    <style>
        body {
            color: chocolate;
            font-size: 18px;
            font-family: "Bookman Old Style";
        }
        h1 {
            color: Chocolate;
            text-decoration: underline;
        }
        a{
            color: chocolate;
            text-decoration: underline;
        }

    </style>
</head>
<body>
<?php
try {
//  define variables and get data from enterDetails.php page
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $countries = $_POST['countries'];
    //ok variable to show if there is any error
    $ok = true;
//input validations
    if (empty($fName)) {
        echo 'First name required <br />';
        $ok = false;
    }
    if (empty($lName)) {
        echo 'Last name  required <br />';
        $ok = false;
    }
    if (empty($email)) {
        echo 'Email is required <br />';
        $ok = false;
    }
    if (!empty($age)) {
        if ($age < 14) {
            echo 'You must be 14 years old';
            $ok = false;
        } else {

            $age = intval($age);
        }
    }


// if code is error free run the command
    if ($ok == true) {
        $conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006assignment1', 'bb90935d50453f', '03ff61b8');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO createProfile(fName,lName,email, age, gender,countries)VALUES( :fName, :lName,:email,:age,:gender,:countries);";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':fName', $fName, PDO::PARAM_STR, 50);
        $cmd->bindParam(':lName', $lName, PDO::PARAM_STR, 50);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 254);
        $cmd->bindParam(':age', $age, PDO::PARAM_INT);
        $cmd->bindParam(':gender', $gender, PDO::PARAM_STR, 6);
        $cmd->bindParam(':countries', $countries, PDO::PARAM_STR, 50);
        $cmd->execute();
        $conn = null;
        echo 'Candidate Information Saved<br>';
    }
}
catch (exception $e) {
    mail('rajvinderyogi@gmail.com', 'Page error', $e);
    header('location:error.php');
}
?>
<!-- link to showDeatils.php page-->
<a href="showDetails.php">Show All User's Profile</a>


<?php require_once ('footer.php') ?>



