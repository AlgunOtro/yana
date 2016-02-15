	<table id="dg" style="width:auto;height:200px" class="easyui-edatagrid" data-options="
		title:'Subgrid Editable',
		fit:true,
		singleSelect:true,
		idField:'id',
		toolbar:'#toolbar',
		/*autoSave:true*/">
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