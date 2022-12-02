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
    <?php 
        if(!isset($_POST['id'])){
            header('location: index.php');
        }
        require_once 'include/database.php';
        include_once 'include/nav.php';
        $id = $_POST['id'];
        $sqlState = $pdo->prepare('SELECT * FROM items WHERE id=?');
        $sqlState->execute([$id]);
        $item = $sqlState->fetch(PDO::FETCH_OBJ);
        if(isset($_POST['modifier2'])){
            $title = $_POST['title'];
            $id = $_POST['id'];
            if(!empty($id) && !empty($title)){
                $sqlState = $pdo->prepare('UPDATE items  SET title=? WHERE id=?');
                $result = $sqlState->execute([$title,$id]);
                if($result == true){
                    header('location:index.php');
                }
            }else{
                ?>
                 <div class="alert alert-danger" role="alert">
                        The <span class='fw-bolder'>title </span> mandatory (required).
                    </div>
                <?php
            }
        }
    ?>
    
    <div class="row g-3 align-items-center">
            <div class="border border-primary p-2 my-5 mx-auto w-75">
                <h4>Modifier tâche</h4>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $item->id?>">
                        <div class="col-auto">
                            <label for="title" class="col-form-label">
                                Title <span class='required'>*</span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="title" name="title" class="form-control" aria-describedby="titleHelpInline" value="<?php echo $item->title?>">
                        </div>
                        <div class="col-auto">
                            <span id="titleHelpInline" class="form-text">
                            Le titre de la tâche.
                            </span>
                        </div>
                        <div class="con-auto">
                            <input class='btn btn-primary rounded-3 my-2' type="submit" value="Modifier" name="modifier2">
                        </div>
                </form>
            </div>
        </div>
</body>
</html>