      <div class="container">
        <table id="dg" class="easyui-edatagrid" data-options="
          title:'USUARIOS',
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
            {field:'usuario',title:'Usuario',width:200,editor:{type:'validatebox',options:{required:true,validType:{length:[1,60]}}}},
            {field:'rol',title:'Rol',width:200,formatter:function(value,row){return row.rol;},editor:{type:'combobox',options:{valueField:'rol',textField:'rol',method:'get',url:'roles_data',required:true,onChange:function(value){var cc= this;setTimeout(function(){var opts = $('#dg').edatagrid('options');var row = $('#dg').edatagrid('getRows')[opts.editIndex];row.rol = $(cc).combobox('getText');return row.rol;},0);}}}},
            {field:'estado',title:'Estado',align:'center',editor:{type:'checkbox',options:{on:'activo',off:'inactivo'}}}
          ]],
          onError:function(index,row){$.messager.alert('Error',row.msg,'error');},
          onSuccess:function(index,row){$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');}">
        </table>
      </div>
      <div id="tb" style="padding:3px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="(function (){ $('#dg').edatagrid('addRow'); }());">Añadir</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="(function (){ $('#dg').edatagrid('cancelRow'); }());">Cancelar</a>
      </div>