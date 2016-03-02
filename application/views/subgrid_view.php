	<table id="dg" style="width:auto;height:100%" class="easyui-edatagrid" data-options="
		title:'Subgrid Editable',
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data',
		autoSave:true,
		singleSelect:true,
		idField:'id',
		loadMsg:'Espera...',
		toolbar:'#toolbar',
		columns:[[
        	{field:'id',title:'Id',width:100},
        	{field:'col_text_10',title:'Col Text',width:100,editor:{type:'textbox',options:{required:true,validType:{length:[5,50]}}}},
        	{field:'col_int',title:'Col Int',width:100,align:'right',editor:{type:'numberbox',options:{required:true}}},
        	{field:'col_double',title:'Col Double',align:'right',width:100,editor:'numberbox'}
    	]],
    	onError:function(index,row){$.messager.alert('Error',row.message,'error');},
    	onSuccess:function(index,row){$.messager.show({title:'Información',msg:'Registro guardado correctamente.',style:{right:'',top:document.body.scrollTop+document.documentElement.scrollTop,bottom:''}});$('#dg').edatagrid('reload');},
    	view:detailview,
    	detailFormatter:function(index,row){
    		return '<div style=&#34;padding:2px&#34;><table class=&#34;ddv&#34;></table></div>';
    	},
    	onExpandRow: function(index,row){
    		var ddv = $(this).edatagrid('getRowDetail',index).find('table.ddv');
    		ddv.edatagrid({
    			url:'obtener_detalle',
    			saveUrl:'insert_data_subgrid',
        	    updateUrl:'update_data_subgrid',
            	destroyUrl:'destroy_data_subgrid',
    			queryParams:{id:row.id},
    			autoSave:true,
    			singleSelect:true,
    			idField:'id',
    			fitColumns:true,
    			rownumbers:true,
    			loadMsg:'Espera...',
    			columns:[[
                    {field:'ck',checkbox:true},
                	{field:'id',title:'ID',width:20},
	                {field:'maestro_id',title:'MAESTRO ID',width:100,editor:'text'},
    	            {field:'col_date',title:'DATE',width:100,align:'right',editor:'text'},
    	            {field:'col_datetime',title:'DATETIME',fixed:true,align:'right',editor:'text'}
        	    ]],
            	toolbar:[{
                	text:'Añadir',
	                iconCls:'icon-add',
    	            handler:function(){
        	            ddv.edatagrid('addRow');
            	    }
	            }],
    	        onResize:function(){
    	            $('#dg').edatagrid('fixDetailRowHeight',index);
        	    },
            	onLoadSuccess:function(){
                	setTimeout(function(){
	                    $('#dg').edatagrid('fixDetailRowHeight',index);
    	            },0);
        	    }
	        });
    	    $('#dg').edatagrid('fixDetailRowHeight',index);
    	}">
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:alert('ayuda');"></a>
	</div>