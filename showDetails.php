<?php
$pageTitle = 'Show Details';
require_once ('header.php'); ?>
    <style>
        body {
            color: chocolate;
            font-family: "Bookman Old Style";
        }
        h1 {
            color: Chocolate;
            text-decoration: underline;

        }
        a{
            color: chocolate;
            text-decoration: none;
        }
        footer{
            background-color: #f7e1b5;
            text-align: center;
            height: 40px;
        }
    </style>

<?php

try
{
// connect database
$conn =new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006assignment1','bb90935d50453f','03ff61b8');
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//write sql query
$sql ="SELECT * FROM createProfile ORDER BY fName";
//execute  the query and store the results
$cmd =$conn->prepare($sql);
$cmd->execute();
$candidates =$cmd->fetchAll();
//table and heading for columns
echo '<table class ="table table-striped table-hover"><tr><th>First Name</th><th>Last Name</th><th>E-mail</th><th>age</th>
<th>Gender</th><th>Country</th></tr>';
//loop through the data
foreach($candidates AS $candidate){
    echo'<tr><td>'.$candidate ['fName'].'</td>
    <td>'.$candidate ['lName'].'</td>
    <td>'.$candidate ['email'].'</td>
    <td>'.$candidate ['age'].'</td> 
    <td>'.$candidate ['gender'].'</td>
    <td>'.$candidate ['countries'].'</td></tr>';

}


//end table
echo '</table><br>';

//disconnect database
$conn =null;

}
catch (exception $e) {
    mail('rajvinderyogi@gmail.com', 'Page error', $e);
    header('location:error.php');
}


?>
<?php require_once ('footer.php'); ?>
