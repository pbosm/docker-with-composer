<?php require_once('./src/includes/header.php') ?>
<?php require_once('./src/includes/sidenavbar.php') ?>
<?php require_once('./src/includes/content.php') ?>

<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div id="chartTreemap"></div>
            <div id="tooltip" class="tooltip"></div>
        </div>
    </div>
</div>

<?php require_once('./src/includes/footer.php') ?>

<?php
    require_once('./src/includes/footer.php');

    use app\api\controller\InstanceController;

    InstanceController::app()->FileController->scriptFile('treeMap', 'treeMap.js') 
?>

<script>
   loadChart();
</script>