<div class="row">
    <div class="col-lg-12" id="cabecera">
        <form id="f-cabecera">
            <label for="s-departamento" >Departamento:</label>
            <select class="form-control" id="s-departamento">
                
            </select>
 
            <label for="s-distrito">Distrito:</label>
            <select class="form-control" id="s-distrito">
            </select>
            
            <label for="s-opcion-lugar">Tipo Lugar:</label>
            <select class="form-control" id="s-opcion-lugar">
                <option></option>
                <option id="comite">Comite</option>
                <option id="asentamiento">Asentamiento</option>
                <option id="compania">Compañia</option>
            </select>
            <br>

            <select class="form-control" id="s-lugar">
                
            </select>
            
            <label for="s-comite">Encuestador:</label>
            <select class="form-control" id="s-encuestador" name="data[FormularioF1][encuestador_id]">
            </select>
            
            
            <label for="s-carpeta">Carpeta:</label>
            <input type="text" class="form-control" id="t-carpeta" name="data[FormularioF1][carpeta_id]">
            
            <label>Periodo Agricola:</label>
            <label for="t-desde">Del 1 DE JULIO:</label>
            <input type="text" class="form-control" id="t-desde" name="data[FormularioF1][fecha_inicio]">
            <label for="t-hasta">Al 30 DE JUNIO:</label>
            <input type="text" class="form-control" id="t-hasta" name="data[FormularioF1][fecha_fin]">
            <label for="t-fecha">Fecha firma:</label>
            <input type="date" class="form-control" id="t-fecha" name="data[FormularioF1][fecha]">
            <label for="t-codigo">Código</label>
            <input type="text" class="form-control" id="t-codigo" name="data[FormularioF1][codigo]" />
            <br>
            
        </form>
    </div>
    <input type="hidden" id="t-hid-edit-cabecera" name="data[FormularioF1][id]">
    <button type="button" class="btn btn-primary" id="b-agregarcabecera">Agregar registros</button>
            

    
    
</div>