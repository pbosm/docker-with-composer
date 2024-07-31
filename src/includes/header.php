<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->title[$this->urlName] ?></title>

    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>src/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

    <div class="x-loader">
        <div class="container">
            <div class="row">
                <div class="mx-auto my-auto">
                    <div class="double-lines-spinner"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert-box alert-box-success">
        <div class="container">
            <button class="btn btn-light" onclick="closeAlertBox()">
                Continuar
            </button>
            <a href="" class="btn-link" style="display: none;">
                <button class="btn btn-light">
                    Continuar
                </button>
            </a>
            <div class="row">
                <div class="my-auto mx-auto text-center">
                    <div style="display: flex;">
                        <div style="background-color: rgb(255, 255, 255);"></div>
                        <span></span>
                        <span></span>
                        <div></div> 
                        <div tyle="background-color: rgb(255, 255, 255);"></div>
                        <div style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <p class="msg"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="alert-box alert-box-error">
        <div class="container">
            <button class="btn btn-light" onclick="closeAlertBox()">
                Tentar novamente
            </button>
            <div class="row">
                <div class="my-auto mx-auto text-center">
                    <div style="display: flex;">
                        <span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <p class="msg"></p>
                </div>
            </div>
        </div>
    </div>

<body>