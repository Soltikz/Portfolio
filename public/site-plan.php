<?php include_once "../includes/handlers/sitemap-handler.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Site Plan";
include_once "../includes/components/head.php";
?>

<body>
    <?php include_once "../includes/components/header.php" ?>
    <main>
        <h1>Plan du site</h1>
        <ul>
            <?php
      foreach ($pages as $page) {
        ?>
            <li>
                <a href="<?php echo $page["file"] ?>"><?php echo $page["title"] ?></a>
            </li>
            <?php
      }
      ?>
        </ul>
    </main>
    <?php include_once "../includes/components/footer.php" ?>
</body>

</html>