      <div class="principal" data-options="region:'center',border:false" style="overflow-y:auto;">
        <table id="dg" class="easyui-edatagrid" title="<?php echo ucfirst($this->router->class);?>" style="width:100%;" data-options="
          url:'obtener_data',
          saveUrl:'actualizar_data',
          updateUrl:'actualizar_data',
          destroyUrl:'eliminar_data',
          <?php if ($total > 5):?>
          pagination:true,
          <?php endif;?>
          fitColumns:true,
          fit:true,
          autoSave:true,
          singleSelect:true,
          idField:'id',
          toolbar:'#tb',
          columns:[[
            {field:'id',title:'Id',fixed:true},
            {field:'nombre',title:'Objeto',fixed:true,editor:{type:'validatebox',options:{required:true,validType:{length:[1,60]}}}},
            {field:'tipo',title:'Tipo',fixed:true,editor:{type:'textbox',options:{required:true,validType:{length:[1,10]}}}},
            {field:'enlace',title:'Enlace',fixed:true,editor:{type:'textbox',options:{required:true,validType:{length:[1,80]}}}},
            {field:'menu',title:'Menú',fixed:true,editor:{type:'numberbox',options:{required:true,validType:{length:[1,1]}}}},
            {field:'estado',title:'Estado',align:'center',editor:{type:'checkbox',options:{on:'activo',off:'inactivo'}}}
          ]],
          onError:function(index,row){$.messager.alert('Error',row.msg,'error');},
          onSuccess:function(index,row){$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');}">
        </table>
      </div>
      <div id="tb">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="(function (){ $('#dg').edatagrid('addRow'); }());">Añadir</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="(function (){ $('#dg').edatagrid('cancelRow'); }());">Cancelar</a>
      </div>