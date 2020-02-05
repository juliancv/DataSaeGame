
<h1>Nuevo jugador:</h1>

<div class="row">
    <form method="post" action="<?php echo base_url('index.php/jugador/store');?>">
        <fieldset>

            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Nombre(s):</label>
                    <input class="form-control " type="text" name="nombre" id="nombre_id" value="" maxlength="60" placeholder="Ingrese los nombres del jugador" required>
                </div>
            </div>
            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Apellido(s):</label>
                    <input class="form-control " type="text" name="apellido" id="apellido_id" value="" maxlength="60" placeholder="Ingrese los apellidos del jugador" required>
                </div>
            </div>

            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Edad:</label>
                    <input class="form-control " type="text" name="edad" id="edad_id" value="" maxlength="60" placeholder="Ingrese la edad del jugador a participar" required>
                </div>
            </div>
            <div class = "col-sm-6">
                <div class = "form-group">
                    <label for="por_apren">Dinero:</label>
                    <input class="form-control " type="text" name="dinero" id="dinero_id" value="" maxlength="60" placeholder="Por defecto el valor será 10.000">
                </div>
            </div>

            <div class = "col-sm-12 form-group">
                <center>
                    <input type="submit" name="Save" value="Agregar" class="btn btn-block btn-primary">
                    
                </center>
            </div>
        
        </fieldset>
    </form>
</div>