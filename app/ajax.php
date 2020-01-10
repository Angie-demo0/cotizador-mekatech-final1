<?php
require_once 'config.php';
//echo json_encode(['status' => 200, 'msg' => 'OK']);
$action = $_POST['action'];
$conceptos = [];
//condicional de cotizador
if(!isset($_SESSION['conceptos'])){
    $_SESSION['conceptos'] = [];
}else{
    $conceptos = $_SESSION['conceptos'];
}

//Array de conceptos
switch ($action) {
    //Añadir concepto
    case 'add_concepto':
        $concepto = 
        [
            'id' => rand(111111,999999),
            'concepto' => $_POST['concepto'],
            'cantidad' => (int) $_POST['cantidad'],
            'precio' => $_POST['precio'],
            'subtotal' => floatval($_POST['cantidad'] * $_POST['precio'])
        ];

        $_SESSION['conceptos'][] = $concepto;
        json_output(json_build(200, 'concepto agregado con exito'));
        break;

    //Borrar concepto 
    case 'delete_concepto':

        if(!isset($_POST['id'])){
            json_output(json_build(400, 'Concepto no valido'));
        }

        $id = (int) $_POST['id'];


        //Cuando no hay conceptos
        if(!isset($_SESSION['conceptos']) || empty($_SESSION['conceptos'])) {
            json_output(json_build(400, 'No hay conceptos en la lista'));
        }

        //Cuando si hay conceptos
        foreach($_SESSION['conceptos'] as $i => $v){
            if($v['id'] == $id){
                unset($_SESSION['conceptos'][$i]);
                json_output(json_build(200, 'concepto borrado con exito'));
            }
        };
        json_output(json_build(400, 'Concepto no valido'));
        break; 

    case 'get_conceptos':
        $conceptos = load_conceptos();
        $subtotal = 0;
        $impuestos = 0;
        $total = 0;

        $output = 
            '<div class="card">
            <div class="card-body">
            <h4 class="card-title">Conceptos actuales</h4>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Acción</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($conceptos as $i => $v){
                    $output .= '
                    <tr>
                        <td>'.$v['concepto'].'</td>
                        <td class="text-center">$'.number_format($v['precio'],2).'</td>
                        <td class="text-center">'.$v['cantidad'].'</td>
                        <td class="text-right">$'.number_format($v['subtotal'],2).'</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success do_get_concepto" data-id="'.$v['id'].'">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger do_delete_concepto" data-id="'.$v['id'].'">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    ';

                    $subtotal += $v['subtotal'];
                };

                $impuestos = (float) $subtotal*0.16;
                $total = $subtotal + $impuestos;

                $output .= '
                    <tr>
                        <td colspan="3">Subtotal</td>
                        <td class="text-right" colspan="1">$'.number_format($subtotal,2).'</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3">Impuestos</td>
                        <td class="text-right" colspan="1">$'.number_format($impuestos,2).'</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3">Total</td>
                        <td class="text-right" colspan="1">
                            <h5>
                                <b>$'.number_format($total,2).'</b>
                            </h5>
                        </td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

        </div>
        </div>';


        json_output(json_build(200, 'Ok', $output));
        break;

    
    
    
    case 'get_concepto':
        //Cargar un solo concepto
        $id = (int) $_POST['id'];
        $concepto = load_concepto($id);

        if(!$concepto) {
            json_output(json_build(400, 'Concepto no valido'));
        }

        $output = 
        '<div class="card" id="wrapper-update-concepto-form">
            <div class="card-body">
            <h4 class="card-title">Actualizar concepto</h4>

            <form id="do_update_concepto">
                <input type="hidden" id="update_id" value="'.$concepto['id'].'">
                <div class="form-group row">
                    <div class="col-xl-6">
                        <label for="concepto">Concepto</label>
                        <input
                            type="text"
                            class="form-control"
                            id="update_concepto"
                            value="'.$concepto['concepto'].'"
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
                                id="update_precio"
                                value="'.$concepto['precio'].'"
                                required="required">
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <label for="cantidad">Cantidad</label>
                        <input
                            type="number"
                            class="form-control"
                            id="update_cantidad"
                            value="'.$concepto['cantidad'].'"
                            min="1"
                            max="200">
                    </div>
                </div>

            
                <button class="btn btn-success" type="submit">Guardar cambios</button>
                <button class="btn btn-danger" type="reset" id="cancel-update">Cancelar</button>
            </form>
            </div>
        </div>
        ';



        json_output(json_build(200, 'OK', $output));
        break;

        //Guardar concepto
    case 'update_concepto':
        $concepto = 
        [
            'id' => $_POST['id'],
            'concepto' => $_POST['concepto'],
            'cantidad' => (int) $_POST['cantidad'],
            'precio' => $_POST['precio'],
            'subtotal' => floatval($_POST['cantidad'] * $_POST['precio'])
        ];

        foreach($_SESSION['conceptos'] as $i => $v){
            if($v['id'] == $concepto['id']){
                $_SESSION['conceptos'][$i] = $concepto;
                json_output(json_build(200, 'concepto actualizado con éxito'));
            }
        }

        json_output(json_build(400, 'Concepto no valido'));
        break;

    default:
        break;
}






