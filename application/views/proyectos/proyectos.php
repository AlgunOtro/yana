      <div class="container">
        <?php foreach ($rows as $row) : ?>
        <?php echo anchor('tareas/listar/'.$row['id'],'<span style="font-size:large;">'.$row['nombre'].'</span>',array('class' => 'easyui-linkbutton easyui-tooltip','data-options' => "size:'large',plain:true",'title'=>$row['nombre']));?>
        <?php endforeach;?>
      </div>