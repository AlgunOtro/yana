      <div class="container" style="height:100%;">
      	<div class="left easyui-droppable" data-options="
                  onDragEnter:function(e,source){
                        $(source).draggable('options').cursor='auto';
                  },
                  onDragLeave:function(e,source){
                        $(source).draggable('options').cursor='not-allowed';
                  },
                  onDrop:function(e,source){
                        var id = $(source).find('p:eq(0)').html();
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url('tareas/actualizar_estado');?>',
                              data: {id: id, estado:1},
                              dataType: 'json'
                        })
                        .done( function( d ) {
                              console.log('done');
                              window.location.reload();
                        })
                        .fail( function( d ) {
                              console.log('fail');
                              console.log(d);
                        });
                  }" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('Pendientes',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e1 as $row) : ?>
      			<tr>
      				<td>
                                    <?php echo anchor('#','<div><p hidden>'.$row['id'].'</p><p style="font-weight:normal;font-size:small;">'.$row['nombre'].'</p></div>',array('class' => 'easyui-linkbutton item easyui-tooltip','data-options' => "plain:true",'style'=>'background:#B8CBED','title'=>'<b>Id:</b> '.$row['id'].'<br><b>Nombre:</b> '.$row['nombre'].'<br><b>Estado:</b> '.$row['estado'].'<br><b>Elemento:</b> '.$row['elemento']));?>
      				</td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      	<div class="center easyui-droppable" data-options="
                  onDragEnter:function(e,source){
                        $(source).draggable('options').cursor='auto';
                  },
                  onDragLeave:function(e,source){
                        $(source).draggable('options').cursor='not-allowed';
                  },
                  onDrop:function(e,source){
                        console.log($(source).find('p:eq(0)').html());
                        var id = $(source).find('p:eq(0)').html();
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url('tareas/actualizar_estado');?>',
                              data: {id: id, estado:2},
                              dataType: 'json'
                        })
                        .done( function( d ) {
                              console.log('done');
                              window.location.reload();
                        })
                        .fail( function( d ) {
                              console.log('fail');
                              console.log(d);
                        });
                  }" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('En proceso',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e2 as $row) : ?>
      			<tr>
      				<td>
      					<?php echo anchor('#','<div><p hidden>'.$row['id'].'</p><p style="font-weight:normal;font-size:small;">'.$row['nombre'].'</p></div>',array('class' => 'easyui-linkbutton item easyui-tooltip','data-options' => "plain:true",'style'=>'background:#B0E9E9','title'=>'<b>Id:</b> '.$row['id'].'<br><b>Nombre:</b> '.$row['nombre'].'<br><b>Estado:</b> '.$row['estado'].'<br><b>Elemento:</b> '.$row['elemento']));?>
      				</td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      	<div class="right easyui-droppable" data-options="
                  onDragEnter:function(e,source){
                        $(source).draggable('options').cursor='auto';
                  },
                  onDragLeave:function(e,source){
                        $(source).draggable('options').cursor='not-allowed';
                  },
                  onDrop:function(e,source){
                        var id = $(source).find('p:eq(0)').html();
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url('tareas/actualizar_estado');?>',
                              data: {id: id, estado:3},
                              dataType: 'json'
                        })
                        .done( function( d ) {
                              console.log('done');
                              window.location.reload();
                        })
                        .fail( function( d ) {
                              console.log('fail');
                              console.log(d);
                        });
                  }" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('Terminadas',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e3 as $row) : ?>
      			<tr>
      				<td>
                                    <?php echo anchor('#','<div><p hidden>'.$row['id'].'</p><p style="font-weight:normal;font-size:small;">'.$row['nombre'].'</p></div>',array('class' => 'easyui-linkbutton item easyui-tooltip','data-options' => "plain:true",'style'=>'background:#B8F4B8','title'=>'<b>Id:</b> '.$row['id'].'<br><b>Nombre:</b> '.$row['nombre'].'<br><b>Estado:</b> '.$row['estado'].'<br><b>Elemento:</b> '.$row['elemento']));?>
      				</td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      </div>