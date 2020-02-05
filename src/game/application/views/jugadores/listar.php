<h2> Jugadores registrados. </h2>

<table class="table">
    <thead>
        <tr>
            <th class="col-xs-1">#</th>
            <th class="col-xs-3">Nombre(s)</th>
            <th class="col-xs-3">Apellido(s)</th>
            <th class="col-xs-2">Edad</th>
            <th class="col-xs-3">Dinero($)</th>
            <th class="col-xs-3">Acciones</th> 
        </tr>
    </thead>
    <tbody>

    <?php if($listaJugadores != null): ?> 
        <?php $numFila = 1; ?>
        <?php foreach ($listaJugadores as $jugador):?>
            <tr>
                <td class="col-xs-2"> <?php echo $numFila ?>  </td>
                <td class="col-xs-8"> <?php echo $jugador->jug_nombre?>  </td>
                <td class="col-xs-2"> <?php echo $jugador->jug_apellido?>  </td>
                <td class="col-xs-2"> <?php echo $jugador->jug_edad?>  </td>
                <td class="col-xs-2"> <?php echo $jugador->jug_dinero?>  </td>
                <td class="col-xs-2"> 
                <form method="GET" action="<?php echo base_url('index.php/jugador/delete/'.$jugador->jug_id); ?>">
                    <a class="btn btn-info btn-xs" href="<?php echo base_url('index.php/jugador/editar/'.$jugador->jug_id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    <button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                </form>
                     
                </td>
            </tr>
            <?php $numFila ++; ?>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="5"> 
                No registros disponibles
            </td>
        </tr>        
    <?php endif; ?>        

    </tbody>
</table>
