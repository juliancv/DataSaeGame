<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div>
    <img src="http://www.datasae.co/wp-content/uploads/2016/06/logo-old.png">
</div>

<div>
    <h2>Jugadores conectados:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Dinero
                </th>
                <th>
                    Cantidad apuesta ($)
                </th>
                <th>
                    Color apuesta
                </th>
            </tr>
        </thead>
        <tdoby>
        
        <?php if($jugadores != false): ?>

            <?php foreach ($jugadores as $jugador): ?>
                 <tr>
                    <td>
                        <?php echo $jugador->jug_nombre?>
                    </td>
                    <td>
                        <?php echo round($jugador->jug_dinero, 1) ?>
                    </td>
                    <?php if(isset($jugador->ap_cantidad)): ?>
                        <td>
                            <?php echo round($jugador->ap_cantidad, 1) ?>
                        </td>
                    <?php else: ?>
                        <td>
                            No se ha realizado la apuesta.
                        </td>
                    <?php endif ?>

                    <?php if(isset($jugador->ap_color)): ?>
                        <td>
                            <?php echo $jugador->ap_color?>
                        </td>
                    <?php else: ?>
                        <td>
                            No se ha realizado la apuesta.
                        </td>
                    <?php endif ?>

                 </tr>
            <?php endforeach ?>        

        <?php else: ?>
            
        <?php endif ?>    
        </tdoby>

    </table>
</div>


<div>
    <center>
        <a href="<?php echo base_url('index.php/generador/generar') ?>"><button class="btn btn-primary"> Generar apuesta </button> </a>
        <a href="<?php echo base_url('index.php/generador/jugar') ?>"><button class="btn btn-danger" style="width:140px"> Jugar </button> </a>    
    </center>       
</div>

<div>
    <h2>Último resultado:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Color apuesta
                </th>
                <th>
                    Color ruleta
                </th>
                <th>
                    ¿Ganó?
                </th>
                <th>
                    Ganancia
                </th>
            </tr>
        </thead>
        <tdoby>

        <?php if($resultadosApu != false):?>
            <?php foreach($resultadosApu as $resultado): ?>
                <tr>
                    <td>
                        <?php echo $resultado->jug_nombre ?>
                    </td>
                    <td>
                        <?php echo $resultado->par_color ?>
                    </td>
                    <td>
                        <?php echo $resultado->par_color_ruleta ?>
                    </td>
                    <td>
                        <?php if($resultado->par_ganancia > 0 ): ?>
                            Sí
                        <?php else: ?>
                            No
                        <?php endif ?>        
                    </td>
                    <td>
                        <?php echo round($resultado->par_ganancia, 1) ?>
                    </td>

                </tr>
            <?php endforeach ?>    
        <?php else: ?>
            <tr>
                <td colspan="5">
                    No hay registros aún.
                </td>
            </tr>
        <?php endif ?>    
        </tdoby>
    </table>
</div>   