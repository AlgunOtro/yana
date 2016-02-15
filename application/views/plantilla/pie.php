    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.easyui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.edatagrid.js'); ?>"></script>
    <script type="text/javascript">
	$('#dg').edatagrid({
		url:'obtener_data',
		saveUrl:'guardar_data',
		updateUrl:'actualizar_data',
		destroyUrl:'eliminar_data'
	});
    function updateActions(index){
    	console.log('updateActions '+index);
        $('#dg').datagrid('refreshRow', index);
    }
    </script>
</body>
</html>