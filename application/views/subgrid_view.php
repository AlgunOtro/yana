	<table id="dg" style="width:auto;height:200px" class="easyui-edatagrid" data-options="
		title:'Subgrid Editable',
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data',
		autoSave:true,
		fit:true,
		singleSelect:true,
		idField:'id',
		toolbar:'#toolbar',
		columns:[[
        	{field:'id',title:'Id',width:100},
        	{field:'col_text_10',title:'Col Text',width:100,editor:{type:'textbox',options:{required:true,validType:{length:[5,50]}}}},
        	{field:'col_int',title:'Col Int',width:100,align:'right',editor:'numberbox'},
        	{field:'col_double',title:'Col Double',align:'right',width:100,editor:'numberbox'}
    	]],
    	onError:function(index,row){$.messager.alert('Error',row.message,'error');},
    	onSuccess:function(index,row){
    	$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');}">
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:alert('ayuda');"></a>
	</div>