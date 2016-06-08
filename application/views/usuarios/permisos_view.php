	<div class="container">
		<table id="dg" class="easyui-edatagrid" data-options="
			title:'PERMISOS',
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
              {field:'rol',title:'Rol',formatter:function(value,row){return row.rol;},editor:{type:'combobox',options:{valueField:'rol',textField:'rol',method:'get',url:'roles_data',required:true,onChange:function(value){var cc= this;setTimeout(function(){var opts = $('#dg').edatagrid('options');var row = $('#dg').edatagrid('getRows')[opts.editIndex];row.rol = $(cc).combobox('getText');return row.rol;},0);}}}},
            	{field:'descripcion',title:'Descripción',fixed:true},
              {field:'objeto',title:'Objeto',width:200,formatter:function(value,row){return row.objeto;},editor:{type:'combobox',options:{valueField:'nombre',textField:'nombre',method:'get',url:'objetos_data',required:true,onChange:function(value){var cc= this;setTimeout(function(){var opts = $('#dg').edatagrid('options');var row = $('#dg').edatagrid('getRows')[opts.editIndex];row.objeto = $(cc).combobox('getText');return row.objeto;},0);}}}},
            	{field:'tipo',title:'Tipo',fixed:true},
            	{field:'operacion',title:'Operación',width:200,formatter:function(value,row){return row.operacion;},editor:{type:'combobox',options:{valueField:'operacion',textField:'operacion',method:'get',url:'operaciones_data',required:true,onChange:function(value){var cc= this;setTimeout(function(){var opts = $('#dg').edatagrid('options');var row = $('#dg').edatagrid('getRows')[opts.editIndex];row.operacion = $(cc).combobox('getText');return row.operacion;},0);}}}}
            ]],
            onError:function(index,row){$.messager.alert('Error',row.msg,'error');},
            onSuccess:function(index,row){$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');}">
		</table>
	</div>
	<div id="tb" style="padding:3px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="(function (){ $('#dg').edatagrid('addRow'); }());">Añadir</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="(function (){ $('#dg').edatagrid('cancelRow'); }());">Cancelar</a>
	</div>