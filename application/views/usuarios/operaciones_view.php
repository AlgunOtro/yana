      <div class="container">
        <table id="dg" class="easyui-edatagrid" data-options="
          title:'OPERACIONES',
          url:'obtener_data',
          saveUrl:'actualizar_data',
          updateUrl:'actualizar_data',
          destroyUrl:'eliminar_data',
          autoSave:true,
          singleSelect:true,
          idField:'id',
          toolbar:'#tb',
          columns:[[
            {field:'id',title:'Id',width:20},
            {field:'operacion',title:'Nombre',width:200,editor:{type:'validatebox',options:{required:true,validType:{length:[1,20]}}}},
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