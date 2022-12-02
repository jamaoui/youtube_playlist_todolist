<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'include/database.php'; ?>
    <?php include_once 'include/nav.php'; ?>
    <div class="container">
        <div class="row g-3 align-items-center">
            <div class="border border-primary p-2 my-5 mx-auto w-75">
            <?php 
            $title = '';
                if(isset($_POST['ajouter'])){
                   $title = htmlspecialchars($_POST['title']);
                   if(!empty($title)){
                       $sqlState = $pdo->prepare("INSERT INTO items VALUES(null,?)");
                       $result = $sqlState->execute([$title]);
                       if($result == true){
                       ?>
                       <div class="alert alert-success" role="alert">
                            La tâche <span class='fw-bolder'>
                                <?= $title?>
                            </span> est bien ajoutée.
                        </div>
                       <?php
                        }
                   }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        The <span class='fw-bolder'>title</span> is mandatory (required).
                    </div>
                    <?php
                   }
                }
            ?>
                <h4>Ajouter tâche</h4>
                <form method="post">
                        <div class="col-auto">
                            <label for="title" class="col-form-label">
                                Title <span class='required'>*</span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="title" name="title" class="form-control" aria-describedby="titleHelpInline">
                        </div>
                        <div class="col-auto">
                            <span id="titleHelpInline" class="form-text">
                            Le titre de la tâche.
                            </span>
                        </div>
                        <div class="con-auto">
                            <input class='btn btn-primary rounded-3 my-2' type="submit" value="Ajouter" name="ajouter">
                        </div>
                </form>
            </div>
        </div>

            <?php 
            $sqlState = $pdo->query("SELECT * FROM todo.items");
            $items = $sqlState->fetchAll(PDO::FETCH_OBJ);
        
            ?>
        <table class="table">
            <tbody>
                <?php 
                foreach($items as $key => $item){
                    ?>
                    <tr>
                        <td>
                        <span class="badge rounded-pill bg-primary"># <?php echo $item->id?></span>
                        </td>
                        <td><?php echo $item->title?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                                <input formaction="modifier.php" class='btn btn-sm rounded-3 btn-primary' type="submit" value="&#9999;" name="modifier">
                                <input formaction="supprimer.php" class='btn btn-sm rounded-3 btn-danger' type="submit" value="&#10008;" name="supprimer" onclick="return confirm('Voulez vous vraiment supprimer <?php echo $item->title ?> ???');">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>