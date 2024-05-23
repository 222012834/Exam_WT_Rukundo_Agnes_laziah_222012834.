<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>virtual internet of things workshops platform</title>
    <!-- here we use bootstrap inorder to make good appearance of this table-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">virtual internet of things workshops platform</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color:blue;">THIS TABLE SHOWS INSTRUCTORS IN THIS PLATFORM </h4>
        <a href="instructors.html" class="btn btn-primary" style="margin-top: 0px;">instructors</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>InstructorID</th>
                    <th>UserID</th>
                    <th>Bio</th>
                    <th>Specialization</th>

                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Call the file that contains database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM instructors";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['InstructorID']}</td>
                        <td>{$row['UserID']}</td> 
                        <td>{$row['Bio']}</td>
                        <td>{$row['Specialization']}</td>
                        <td>
                            <a href='updateinstructors.php?InstructorID={$row['InstructorID']}' class='btn btn-primary btn-sm'>Update</a></td>
                            <td>
                            <a href='deleteinstructors.php?InstructorID={$row['InstructorID']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </center>
</body>
</html>

