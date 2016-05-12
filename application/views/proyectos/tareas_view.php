      <div class="container" style="height:100%;">
      	<div class="left" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('Pendientes',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e1 as $row) : ?>
      			<tr>
      				<td><div class="item">
      					<?php echo anchor('elementos/listar/'.$row['id'],'<span style="font-size:small;">'.$row['nombre'].'</span>',array('class' => 'easyui-linkbutton','data-options' => "plain:true",'style'=>'background:#B8CBED'));?>
      				</div></td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      	<div class="center" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('En proceso',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e2 as $row) : ?>
      			<tr>
      				<td><div class="item">
      					<?php echo anchor('elementos/listar/'.$row['id'],'<span style="font-size:small;">'.$row['nombre'].'</span>',array('class' => 'easyui-linkbutton','data-options' => "plain:true",'style'=>'background:#B0E9E9'));?>
      				</div></td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      	<div class="right" style="float:left;border-style: solid; border-width: 1px;width:33%;height:100%;">
      		<?php echo heading('Terminadas',3,'style="text-align:center;"');?>
      		<table>
      			<?php foreach ($e3 as $row) : ?>
      			<tr>
      				<td><div class="item">
      					<?php echo anchor('elementos/listar/'.$row['id'],'<span style="font-size:small;">'.$row['nombre'].'</span>',array('class' => 'easyui-linkbutton','data-options' => "plain:true",'style'=>'background:#B8F4B8'));?>
      				</div></td>
      			</tr>
      			<?php endforeach;?>
      		</table>
      	</div>
      </div>