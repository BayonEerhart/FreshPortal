<?php

$host = '127.0.0.1';
$db = 'Freshportal';
$user = 'bit';
$pass = 'bit';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$stmt = $pdo->prepare("SELECT * FROM `employee`");
$stmt->execute();

$data = $stmt->fetchall();

$stmt = $pdo->prepare("SELECT COUNT(*) as employee_count FROM employee");
$stmt->execute();
$amount = $stmt->fetchColumn()-1; 

function get_value($value)
{
    if (isset($_GET[$value])) {
        return $_GET[$value];
    }
    else{
        return;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Fresh portal</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-end">
        <img class="w-25" src="pictures/FreshPortalLogo.jpg" alt="FreshPortalLogo" srcset="pictures/FreshPortalLogo.jpg">
        <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">nieuw</button>
    </div>

 
    


    <div class="modal fade" id="email-fail" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add">employee <?=  get_value("id") ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="nieuw.php" method="post">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">voor naam</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= get_value("firstName")?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">achter naam</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= get_value("firstName")?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label ">email</label>
                                    <input type="email" class="form-control border border-danger border-3" id="email" name="email" value="<?= get_value("email")?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="adres" class="form-label">adres</label>
                                    <input type="text" class="form-control" id="adres" name="adres" value="<?= get_value("adres")?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">leeftijd</label>
                                    <input type="date" class="form-control" id="age" name="age" value="<?= get_value("age")?>" required>
                                </div>
                                <?php if (get_value("id") != ""){ ?>
                                <div style="visibility: hidden">
                                    <label for="id" class="form-label"></label>
                                    <input type="number" class="form-control" id="id" name="id" value="<?= get_value("id")?>" required>
                                </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-primary">opslaan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



    <table class="table  table-borderless rounded-table ">
        <thead class="table-secondary border-table-with  border-white">
            <tr>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">adres</th>
                <th scope="col">geboortedatum</th>
                <th scope="col">acties</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i <= $amount; $i++): ?>
            <tr class="rounded-3 table-secondary">
                <td><?= $data[$i][1] . " " . $data[$i][2]?></td>
                <td><?= $data[$i][3]?></td>
                <td><?= $data[$i][4]?></td>
                <td><?= $data[$i][5]?></td>
                <td>
                    <div>
                        <button type="button" class="btn btn-warning " id="test"  data-bs-toggle="modal" data-bs-target="#edit-<?=  $data[$i][0]?>"><img src="pictures/pencilIcon.png" alt="pencilIcon.png" srcset="pictures/pencilIcon.png" class=" small-img"></button>
                        <a href="remove.php?id=<?= $data[$i][0]?>"><button type="button" class="btn btn-danger "><img src="pictures/trashicon.png" alt="trashicon.png" srcset="pictures/trashicon.png" class=" small-img"></button></a>
                    </div>
                </td>
            </tr>
            

            <div class="modal fade" id="edit-<?=  $data[$i][0] ?>" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add">employee <?=  $data[$i][0] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="nieuw.php" method="post">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">voor naam</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $data[$i][1]?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">achter naam</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $data[$i][2]?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $data[$i][3]?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="adres" class="form-label">adres</label>
                                    <input type="text" class="form-control" id="adres" name="adres" value="<?= $data[$i][4]?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">leeftijd</label>
                                    <input type="date" class="form-control" id="age" name="age" value="<?= $data[$i][5]?>" required>
                                </div>
                                <div style="visibility: hidden">
                                    <label for="id" class="form-label"></label>
                                    <input type="number" class="form-control" id="id" name="id" value="<?= $data[$i][0]?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">opslaan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php endfor; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="nieuw.php" method="post">
                <div class="mb-3">
                    <label for="firstName" class="form-label">voor naam</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">achter naam</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="adres" class="form-label">adres</label>
                    <input type="text" class="form-control" id="adres" name="adres" required>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">leeftijd</label>
                    <input type="date" class="form-control" id="age" name="age" required>
                </div>
                <button type="submit" class="btn btn-primary">toevoegen</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="script.js"></script>
<?php
    if (isset($_GET["age"])){
        echo "<script>openModal()</script>";
    }
    ?>

</body>
</html>
