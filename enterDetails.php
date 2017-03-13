<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Tell About Yourself</title>
    <!--styles here link and custom-->
<style>

    body {
        font-family: "Bookman Old Style";
        background-image: url("rajBackground.jpg");
        background-size: cover;
        color: chocolate;
        font-size: 18px;
    }
    h1 {
        color: cornflowerblue;

        text-decoration: underline;

    }
    a{
        color: chocolate;
        text-decoration: underline;
    }
    form{
        margin-left:100px;
    }
    fieldset{
        margin: 10px;
        width: 300px;
    }

</style>
</head>
<body>
<h1 align="center">Create Your Profile</h1>


<form method="post" action="saveDetails.php">
    <fieldset>
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName" placeholder="Your First Name" pattern="[A-Za-z]{1,19}" required />
    </fieldset>
    <fieldset>
        <label for="lName">Last Name:</label>
        <input type="text" id="lName" name="lName" placeholder="Your Last Name" pattern="[A-Za-z]{1,19}" required/>
    </fieldset>
    <fieldset>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required placeholder="abc@example.com"/>
    </fieldset>
    <fieldset>
        <label for="age">Age</label>
        <input type="number" id="age" name="age" required placeholder="must be 14 years old"/>
    </fieldset>

    <!--Drop down data for gender using HTML tags -->
    <fieldset>
        <label for="gender">Gender </label>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">Others</option>
        </select>
    </fieldset>
    <!-- Drop down data of countries using databse-->
    <fieldset>
    <label for="countries" >Country</label>
    <select name="countries" id="countries">
        <?php
        //Connect database
        try {
        $conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006assignment1', 'bb90935d50453f', '03ff61b8');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Set up  query
        $sql = "SELECT * FROM countries GROUP BY country_name ORDER BY country_name";

        //run query and store results
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $countrynames = $cmd->fetchAll();

        //loop thru data
        foreach ($countrynames as $countryname){
            //print each album as a new row
            echo '<option>'. $countryname['country_name'] .'</option>';

        }

        //disconnect database connection
        $conn = null;
        }
        catch (exception $e) {
            mail('rajvinderyogi@gmail.com', 'Page error', $e);
            header('location:error.php');
        }
        ?>

    </select>
    </fieldset>

        <button type="submit" value="submit">Submit</button>
        <button type="reset" value="reset">Reset</button><br>

    <a href="showDetails.php">See Profile Details</a><br>
</form>

</body>
</html>