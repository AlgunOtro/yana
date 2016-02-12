    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.easyui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.edatagrid.js'); ?>"></script>
    <script type="text/javascript">
    function updateActions(index){
        $('#dg').edatagrid('refreshRow', index);
    }
    </script>
</body>
</html>