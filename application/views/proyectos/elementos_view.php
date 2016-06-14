	<table id="dg" style="width:auto;" class="easyui-edatagrid" data-options="
		title:'Elementos',
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data',
        queryParams:{id:proyecto_id},
		autoSave:true,
		singleSelect:true,
		idField:'id',
		loadMsg:'Espera...',
		toolbar:'#toolbar',
        fit:true,
        pagination:true,
        pageList:[10,20,50,100,500],
		columns:[[
        	{field:'id',title:'Id'},
        	{field:'nombre',title:'Nombre',width:200,editor:{type:'textbox',options:{required:true,validType:{length:[2,100]}}}},
        	{field:'creado',title:'Creado'},
            {field:'modificado',title:'Modificado'},
            {field:'usuario',title:'Usuario',fixed:true},
            {field:'direccion_ip',title:'Dirección IP',fixed:true},
            {field:'cambios',title:'Cambios',width:100},
            {field:'proyecto_id',title:'Proyecto Id',hidden:true,editor:{type:'numberbox',options:{requiered:true}},fixed:true},
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
        onBeginEdit(index,row){
            var editors = $('#dg').datagrid('getEditors', index);
            var n1 = $(editors[1].target);
            n1.numberbox('setValue', proyecto_id);
        },
        onBeforeLoad(){
            console.log('onBeforeLoad');
            if(typeof(proyecto_id) != &#34;undefined&#34;){ console.log(&#34;si existe&#34;+proyecto_id); }
        },
        onLoadSuccess(data){
            if(typeof(proyecto_id) != &#34;undefined&#34;){ console.log(&#34;si existe&#34;+proyecto_id); }
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
        },
    	view:detailview,
    	detailFormatter:function(index,row){
    		return '<div style=&#34;padding:2px&#34;><table class=&#34;ddv&#34;></table></div>';
    	},
    	onExpandRow: function(index,row_master){
    		var ddv = $(this).edatagrid('getRowDetail',index).find('table.ddv');
    		ddv.edatagrid({
    			url:'obtener_detalle',
    			saveUrl:'guardar_detalle',
        	    updateUrl:'actualizar_detalle',
            	destroyUrl:'eliminar_detalle',
    			queryParams:{elemento_id:row_master.id,proyecto_id:row_master.proyecto_id},
    			autoSave:true,
    			idField:'id',
    			fitColumns:true,
    			rownumbers:true,
    			loadMsg:'Espera...',
    			columns:[[
                    {field:'id',title:'Id'},
                    {field:'nombre',title:'Nombre',width:200,editor:{type:'textbox',options:{required:true,validType:{length:[2,100]}}}},
                    {field:'creado',title:'Creado'},
                    {field:'modificado',title:'Modificado'},
                    {field:'usuario',title:'Usuario',fixed:true},
                    {field:'direccion_ip',title:'Dirección IP',fixed:true},
                    {field:'cambios',title:'Cambios',width:100},
                    {field:'elemento_id',title:'Elemento Id',hidden:true,editor:{type:'numberbox',options:{requiered:true}},fixed:true},
                    {field:'estado',title:'Estado',fixed:true}
        	    ]],
            	toolbar:[{
	                iconCls:'icon-add',
    	            handler:function(){
        	            ddv.edatagrid('addRow');
            	    }
	            },{
                    iconCls:'icon-remove',
                    handler:function(){
                        ddv.edatagrid('destroyRow');
                    }
                },{
                    iconCls:'icon-cancel',
                    handler:function(){
                        ddv.edatagrid('clearSelections');
                        ddv.edatagrid('cancelRow');
                    }
                },'-',{
                    iconCls:'icon-help',
                    handler:function(){
                        $.messager.alert('Error','Nadie te puede ayudar','error');
                    }
                }],
    	        onResize:function(){
    	            $('#dg').edatagrid('fixDetailRowHeight',index);
        	    },
            	onLoadSuccess:function(){
                	setTimeout(function(){
	                    $('#dg').edatagrid('fixDetailRowHeight',index);
    	            },0);
        	    },
                onError:function(index,row){
                    $.messager.alert('Error',row.message,'error');
                },
                onBeginEdit(index,row){
                    var editors = ddv.datagrid('getEditors', index);
                    var n1 = $(editors[1].target);
                    n1.numberbox('setValue', row_master.id);
                },
                onSuccess:function(index,row){
                    $.messager.show({
                        title:'Información',
                        msg:'Registro guardado correctamente.',
                        style:{
                            right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''
                        }
                    });
                    ddv.edatagrid('reload');
                },
                onDestroy:function(index,row){
                    $.messager.show({
                        title:'Información',
                        msg:'Registro eliminado correctamente.',
                        style:{
                            right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''
                        }
                    });
                    ddv.edatagrid('reload');
                },
                destroyMsg:{
                    norecord:{
                        title:'Advertencia',
                        msg:'Ningún registro seleccionado.'
                    },
                    confirm:{
                        title:'Confirmación',
                        msg:'Estás seguro de eliminar el registro?'
                    }
                }
	        });
    	    $('#dg').edatagrid('fixDetailRowHeight',index);
    	}">
	</table>
    <script type="text/javascript">
    proyecto_id='0';
    </script>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow');"></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:$.messager.alert('Error','Nadie te puede ayudar','error');"></a>
        <input id="cc" class="easyui-combobox" name="proyecto" data-options="prompt:'Proyectos',valueField:'id',textField:'nombre',url:'proyectos_data',onSelect:function(record){proyecto_id=record.id;$('#dg').edatagrid('load',{id:record.id});}">
	</div>