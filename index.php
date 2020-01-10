<?php
require_once 'app/config.php';
//session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <base href="">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cotizador Mekatech</title>
        <link href="assets/css/styles.css">
        <!--Jquery and JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="assets/js/main.js"></script>
        <!--BOOTSTRAP-->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
            crossorigin="anonymous">
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a48303c2c2.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">

        <div class="container-fluid py-3">

            <div class="row mb-5">
                <div class="col-xl-12">
                    <div class="encabezado">
                        <h1 class="text-center text-warning">Cotizador Mekatech</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <!---------FORMULARIO PP-------->
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-12">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Agregar nuevo concepto</h4>

                                    <form id="do_add_concept">
                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <label for="concepto">Concepto</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="concepto"
                                                    placeholder="Escribe un concepto..."
                                                    required="required">
                                            </div>

                                            <div class="col-xl-3">
                                                <label for="precio">Precio</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>

                                                    </div>

                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="precio"
                                                        placeholder="0.00"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="cantidad"
                                                    value="1"
                                                    min="1"
                                                    max="200">
                                            </div>
                                        </div>

                                        <!--BOTONES DE FORMULARIO-->
                                        <button class="btn btn-success" type="submit">Agregar concepto</button>
                                        <button class="btn btn-danger" type="reset">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12" id="wrapper-form">
                            <!--Ajax -Editar concepto-->
                        </div>
                    </div>
                </div>

                <!---------TABLA DE CONCEPTOS-------->
                <div class="col-md-8" id='wrapper-cotizacion'>
                    <!--------Ajax fall--------->
                </div>
            </div>
        </div>

        <!--Jquery and JS-->

        <script src="assets/js/main.js"></script>
        <script src="app/ajax.php"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    </body>
</html>