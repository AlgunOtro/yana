      <div class="principal" data-options="region:'center',border:false" style="overflow-y:auto;">
        <table id="dg" class="easyui-edatagrid" title="<?php echo ucfirst($this->router->class);?>" style="width:100%;" data-options="
          url:'obtener_data',
          saveUrl:'actualizar_data',
          updateUrl:'actualizar_data',
          destroyUrl:'eliminar_data',
          fitColumns:true,
          fit:true,
          autoSave:true,
          singleSelect:true,
          idField:'id',
          toolbar:'#tb',
          columns:[[
          <?php if ($this->config->item("tiene_directorio_activo")) {
            $campo_usuario = 'usuario';
            $campo_estado = 'estado';
          }
          else
          {
            $campo_usuario = 'username';
            $campo_estado = 'activated';
          }?>
            {field:'id',title:'Id',fixed:true},
            {field:'<?php echo $campo_usuario;?>',title:'Usuario',fixed:true,editor:{type:'validatebox',options:{required:true,validType:{length:[1,60]}}}},
            {field:'usuario_generico',title:'Usuario Genérico',fixed:true,editor:{type:'validatebox',options:{required:true,validType:{length:[1,60]}}}},
            {field:'rol',title:'Rol',fixed:true,formatter:function(value,row){return row.rol;},editor:{type:'combobox',options:{valueField:'rol',textField:'rol',method:'get',url:'roles_data',required:true,onChange:function(value){var cc= this;setTimeout(function(){var opts = $('#dg').edatagrid('options');var row = $('#dg').edatagrid('getRows')[opts.editIndex];row.rol = $(cc).combobox('getText');return row.rol;},0);}}}},
            {field:'<?php echo $campo_estado;?>',title:'Estado',align:'center',editor:{type:'checkbox',options:{on:'activo',off:'inactivo'}}}
          ]],
          onError:function(index,row){$.messager.alert('Error',row.msg,'error');},
          onSuccess:function(index,row){$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');}">
        </table>
      </div>
      <div id="tb" style="padding:3px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="(function (){ $('#dg').edatagrid('addRow'); }());"></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="(function (){ $('#dg').edatagrid('cancelRow'); }());"></a>
      </div>