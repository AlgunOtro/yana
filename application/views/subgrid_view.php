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
        },
    	view:detailview,
    	detailFormatter:function(index,row){
    		return '<div style=&#34;padding:2px&#34;><table class=&#34;ddv&#34;></table></div>';
    	},
    	onExpandRow: function(index,row){
    		var ddv = $(this).edatagrid('getRowDetail',index).find('table.ddv');
    		ddv.edatagrid({
    			url:'obtener_detalle',
    			saveUrl:'guardar_detalle',
        	    updateUrl:'actualizar_detalle',
            	destroyUrl:'eliminar_detalle',
    			queryParams:{id:row.id},
    			autoSave:true,
    			idField:'id',
    			fitColumns:true,
    			rownumbers:true,
    			loadMsg:'Espera...',
    			columns:[[
                	{field:'id',title:'ID',width:20},
	                {field:'maestro_id',width:100,hidden:true},
    	            {field:'col_date',title:'DATE',width:100,align:'right',editor:{type:'datebox',options:{required:true}}},
    	            {field:'col_datetime',title:'DATETIME',fixed:true,align:'right',editor:{type:'datetimebox',options:{required:true}}}
        	    ]],
            	toolbar:[{
	                iconCls:'icon-add',
    	            handler:function(){
        	            ddv.edatagrid('addRow',{
                            row:{
                                maestro_id:row.id
                            }
                        });
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
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow');"></a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow');"></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow');"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-help" plain="true" onclick="javascript:$.messager.alert('Error','Nadie te puede ayudar','error');"></a>
	</div>