	<table id="dg" style="width:auto;" class="easyui-edatagrid" data-options="
		title:'Proyectos',
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data',
		pagination:true,
		pageList: [10,50,100,200,500,1000],
		autoSave:true,
		singleSelect:false,
		idField:'id',
		loadMsg:'Espera...',
		toolbar:'#toolbar',
		fitColumns:true,
		fit:true,
		columns:[[
        	{field:'id',title:'Id'},
        	{field:'nombre',title:'Nombre',width:200,fixed:true,editor:{type:'textbox',options:{required:true,validType:{length:[2,100]}}}},
        	{field:'creado',title:'Creado'},
        	{field:'modificado',title:'Modificado'},
        	{field:'usuario',title:'Usuario',fixed:true},
        	{field:'direccion_ip',title:'Dirección IP',fixed:true},
        	{field:'cambios',title:'Cambios',width:100},
        	{field:'estado',title:'Estado',fixed:true}
    	]],
        destroyMsg:{
            norecord:{
                title:'Advertencia',
                msg:'Ningún registro seleccionado.'
            },
            confirm:{
                title:'Confirmación',
                msg:'Estás seguro de eliminar el registro?'
            }
        },
    	onError:function(index,row){
            $.messager.alert('Error',row.message,'error');
        },
    	onSuccess:function(index,row){
            $.messager.show({
                title:'Información',
                msg:'Registro guardado correctamente.',
                style:{
                    right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''
                }
            });
            $('#dg').edatagrid('reload');
        }">
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow');"></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:$.messager.alert('Error','Nadie te puede ayudar','error');"></a>
	</div>