	<table id="dg" style="width:auto;height:200px" class="easyui-edatagrid" data-options="url: 'obtener_data',saveUrl: 'guardar_data',updateUrl: 'actualizar_data',destroyUrl: 'eliminar_data',autoSave:true, onBeforeEdit:function(index,row){ row.editing = true; updateActions(index); }, onAfterEdit:function(index,row){ row.editing = false; updateActions(index); }, onCancelEdit:function(index,row){ row.editing = false; updateActions(index); },onError: function(index,row){ alert(row.message); },onSuccess:function(index,row) { $('#dg').datagrid('reload'); },title:'Datagrid Editable',fit:'true',singleSelect:'true',idField:'id',toolbar:'#toolbar'">
		<thead>
			<tr>
				<th field="col1" width="250" editor="text">Col 1</th>
				<th field="col2" width="80" editor="text">Col 2</th>
				<th field="col3" width="80" editor="text">Col 3</th>
				<th field="col4" width="300" editor="text">Col 4</th>
				<th field="col5" width="100" editor="text">Col 5</th>
				<th field="col6" width="200" editor="text">Col 6</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">  
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')"></a>  
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:alert('ayuda')"></a>  
	</div>