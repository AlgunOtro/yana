      <div class="principal" data-options="region:'center',border:false" style="overflow-y:auto;">
        <table id="dg" class="easyui-edatagrid" title="<?php echo ucfirst($this->router->class);?>" style="width:100%;" data-options="
          url:'obtener_data',
          saveUrl:'actualizar_data',
          updateUrl:'actualizar_data',
          destroyUrl:'eliminar_data',
          pagination:true,
          fitColumns:true,
          fit:true,
          autoSave:true,
          singleSelect:true,
          idField:'id',
          toolbar:'#tb',
          columns:[[
            {field:'id',title:'Id',fixed:true},
            {field:'operacion',title:'Operación',fixed:true,editor:{type:'validatebox',options:{required:true,validType:{length:[1,20]}}}},
            {field:'estado',title:'Estado',align:'center',editor:{type:'checkbox',options:{on:'activo',off:'inactivo'}}}
          ]],
          onError: function(index,row){alert(row.msg);},
          onSuccess: function(index,row){$('#dg').edatagrid('reload');}">
        </table>
      </div>
      <div id="tb" style="padding:3px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="(function (){ $('#dg').edatagrid('addRow'); }());">Añadir</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="(function (){ $('#dg').edatagrid('cancelRow'); }());">Cancelar</a>
      </div>