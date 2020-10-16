<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php 
     if (isset($_SESSION['message'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>

     <?php endif?>

    <div class="container">
    <?php
        $mysqli = new mysqli('localhost', 'root', 'root', 'qwest') or die (mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM person") or die ($mysqli->error);
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>lastname</th>
                    <th>Address</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
    <?php
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['firstname'] ?></td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id_person']; ?>" 
                        class="btn btn-info">Edit</a> 
                    <a href="process.php?delete=<?php echo $row ['id_person']; ?>"
                        class="btn btn-danger">Delete<a/>

                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php
        //pre_r($result);
   
  

        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }


    ?>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id_person" value="<?php echo $id_person; ?>">
            <div class="form-group">
            <label for="">Firstname: </label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="Enter your firstname">
            </div>

            <div class="form-group">
            <label>Lastname: </label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Enter your Lastname">
            </div>

            <div class="form-group">
            <label>Address: </label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Enter your address">
            </div>

            <div class="form-group">
            <?php 
                if($update == true):
             ?>
             <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</div>
</body>
</html>