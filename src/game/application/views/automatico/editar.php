<div>

    <h1> ¿Juego automático activado? </h1>
    <?php 

        $selectedSi = "";
        $selectedNo = "";

        if($valorEditar == 'si'){
            $selectedSi = "selected";            
        }else{
            $selectedNo = "selected";
        }           
    ?>
    <form method="post" action="<?php echo base_url('index.php/automatico/actualizar');?>">
        <fieldset>
            <div class="form-group">
                <select class="form-control" id="cambiarAut" name="cambiar_sel">
                    <option value="si" <?php echo $selectedSi ?>>Sí</option>
                    <option value="no" <?php echo $selectedNo ?>>No</option>
                </select>
            </div>

            <div class = "col-sm-12 form-group">
                <center>
                    <input type="submit" name="Save" value="Guardar" class="btn btn-block btn-primary">                        
                </center>
            </div>
        </fieldset>
    </form>

</div>    