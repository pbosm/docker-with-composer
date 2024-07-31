<?php require_once('./src/includes/header.php') ?>
<?php require_once('./src/includes/sidenavbar.php') ?>
<?php require_once('./src/includes/content.php') ?>

<div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong"
                    style="border-radius: 15px; background-color: antiquewhite;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Converter Números</h3>
                    <form id="formNumbers">
                        <div class="mb-4">
                            <div class="row">
                                <span class="mb-4" id="msgErrorNumber" style="background: red; text-align:center"></span>
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <label class="mb-2" for="realNumber">Número Real</label>
                                        <input class="form-control form-control-lg" type="text" id="realNumber"
                                                name="realNumber">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-lg mt-4" onclick="convertToReal()">
                                        Converter para Número Real
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <label class="mb-2" for="romanNumber">Número Romano</label>
                                        <input class="form-control form-control-lg" type="text" id="romanNumber"
                                                name="romanNumber">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-lg mt-4" onclick="convertToRoman()">
                                        Converter para Número Romano
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('./src/includes/footer.php');

    use app\api\controller\InstanceController;

    InstanceController::app()->FileController->scriptFile('homePage', 'homePage.js') 
?>
