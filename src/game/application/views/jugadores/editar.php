<h1>Editar jugador:</h1>

<div class="row">
    <form method="post" action="<?php echo base_url('index.php/jugador/update');?>">
        <fieldset>
            <input type="hidden" value="<?php echo $id ?>" name="jug_id">
            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Nombre(s):</label>
                    <input class="form-control " type="text" name="nombre_edit" id="nombre_edit_id" value="<?php echo $jugador->jug_nombre ?>" maxlength="60" placeholder="Ingrese los nombres del jugador" required>
                </div>
            </div>
            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Apellido(s):</label>
                    <input class="form-control " type="text" name="apellido_edit" id="apellido_edit_id" value="<?php echo $jugador->jug_apellido ?>" maxlength="60" placeholder="Ingrese los apellidos del jugador" required>
                </div>
            </div>

            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Edad:</label>
                    <input class="form-control " type="text" name="edad_edit" id="edad_edit_id" value="<?php echo $jugador->jug_edad ?>" maxlength="60" placeholder="Ingrese la edad del jugador a participar" required>
                </div>
            </div>
            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Dinero:</label>
                    <input class="form-control " type="text" name="dinero_edit" id="dinero_edit_id" value="<?php echo $jugador->jug_dinero ?>" maxlength="60" placeholder="Por defecto el valor será 10.000">
                </div>
            </div>

            <div class = "col-sm-12 form-group">
                <center>
                    <input type="submit" name="Update" value="Actualizar" class="btn btn-block btn-primary">
                    
                </center>
            </div>
        
        </fieldset>
    </form>
</div>