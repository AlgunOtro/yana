	<table id="dg" style="width:auto;height:200px" class="easyui-edatagrid" data-options="url: 'obtener_data',saveUrl: 'guardar_data',updateUrl: 'actualizar_data',destroyUrl: 'eliminar_data',autoSave:true, onBeforeEdit:function(index,row){ row.editing = true; updateActions(index); }, onAfterEdit:function(index,row){ row.editing = false; updateActions(index); }, onCancelEdit:function(index,row){ row.editing = false; updateActions(index); },onSuccess:function(index,row) { $('#dg').datagrid('reload'); },title:'Datagrid Editable',fit:'true',singleSelect:'true',idField:'id',toolbar: [{ iconCls: 'icon-add',handler: function(){ $('#dg').edatagrid('addRow'); } },'-',{iconCls: 'icon-help',handler: function(){alert('ayuda')} }]">
		<thead>
			<tr>
				<th field="id" width="20">Id</th>
				<th field="nombre" width="250" editor="text">Cliente</th>
				<th field="ci_ruc" width="80" editor="text">CI/Ruc</th>
				<th field="telefono" width="80" editor="text">Teléfono</th>
				<th field="direccion" width="300" editor="text">Dirección</th>
			</tr>
		</thead>
	</table>