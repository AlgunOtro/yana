	<table id="dg" style="width:auto;height:200px" class="easyui-edatagrid" data-options="
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data',
		title:'Subgrid Editable',
		fit:true,
		singleSelect:true,
		idField:'id',
		toolbar:'#toolbar',
		onBeforeEdit:function(index,row){
			console.log('onBeforeEdit');
			row.editing = true;
			updateActions(index);
		},
		onAfterEdit:function(index,row){ 
			console.log('onAfterEdit');
			row.editing = false;
			updateActions(index);
		},
		onCancelEdit:function(index,row){
			console.log('**********************************************************************OnCancelEdit1'+index);
			row.editing = false;
			updateActions(index);
		},
		onAdd:function(index,row){
			$.messager.show({
				title:'onAdd',
				msg:'Fila Añadida '+index+' '+row,
				showType:'slide'
			});
		},
		onEdit:function(index,row){
			$.messager.show({
				title:'onAdd',
				msg:'Editando Fila '+index+' '+row,
				showType:'slide'
			});
		},
		onBeforeSave:function(index){
			$.messager.show({
				title:'onBeforeSave',
				msg:'Antes de guardar '+index,
				showType:'slide'
			});
		},
		onSave:function(index,row){
			$.messager.show({
				title:'onSave',
				msg:'Guardar '+index+' '+row,
				showType:'slide'
			});
		},
		onSuccess:function(index,row){
			$('#dg').edatagrid('reload');
			$.messager.show({
				title:'onSuccess',
				msg:'onSuccess '+index+' '+row,
				showType:'slide'
			});
		},
		onDestroy:function(index,row){
			$.messager.show({
				title:'onDestroy',
				msg:'Destruir '+index+' '+row,
				showType:'slide'
			});
		},
		onError:function(index,row){
			$.messager.alert('onError','Error en fila '+index+' '+row,'error');
		}/*,autoSave:true*/">
		<thead>
			<tr>
				<th field="id" width="250" editor="text">Id</th>
				<th field="col_text_10" width="80" editor="text">Col Text</th>
				<th field="col_int" width="80" editor="text">Col Int</th>
				<th field="col_double" width="300" editor="text">Col Double</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">  
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a>  
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:alert('ayuda');"></a>  
	</div>