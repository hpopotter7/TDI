  <form id='form_cliente_extranjero' method='post' action='#'>
            <div  class="row">
               <div class="form-group col-md-6 ">
                  <label id='l_ex_cli' for="name" class="cols-sm-2 control-label">Clientes registrados</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <select  id="c_ex_clientes_alta" name='c_ex_clientes_alta' class='form-control' >
                        </select>
                     </div>
                  </div>
               </div>
               <div id='check_pendientes' class="form-group col-md-4 abajo">
                  <div class="checkbox">
                     <label>
                     <input id='check_ex_solicitud_pendientes' type="checkbox" class="fa fa-square-o fa-2x" value="solicitudes">
                     <span class="label_check" >Solicitudes pendientes</span>
                     </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-6 ">
                  <label id='l_razon' for="name" class="cols-sm-2 control-label">Razon Social del cliente</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_cliente' name='txt_nombre_cliente' type="text" class="form-control" placeholder="Razon Social" required />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">RFC</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        <input id='txt_nif' name='txt_nif' type="text" class="form-control" placeholder="RFC" value='XEXX010101000' readonly="readonly" disabled/>
                     </div>
                  </div>
               </div>
               
            </div>
         </form>
    