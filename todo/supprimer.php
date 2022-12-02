<?php
    if(isset($_POST['supprimer'])){
        require_once 'include/database.php';
        $id = $_POST['id'];
        $sqlState = $pdo->prepare('DELETE FROM items WHERE id=?');
        $sqlState->execute([$id]);
        header('location: index.php');
    }
?>