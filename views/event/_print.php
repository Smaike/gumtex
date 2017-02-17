<table>
	<?php foreach($models as $model){?>
	<tr>
		<td>
			<?=$model->date?>	
		</td>
		<td>
			<?=$model->client->fullName?>	
		</td>
	</tr>
	<?php }?>
</table>