<table border="0" cellspacing="0" cellpadding="0">
	<?php foreach($models as $model){?>
	<tr>
		<td width="20%" >
			<?=$model->date?>	
		</td>
		<td width="20%" >
			<?=$model->client->fullName?>	
		</td>
		<td width="15%" >
			<?php foreach($model->eS as $es){?>
				<?=$es->idService->name?><br>
			<?php }?>
		</td>
		<td width="15%" >
		</td>
		<td width="15%" >
		</td>
		<td width="15%" >
		</td>
	</tr>
	<?php }?>
</table>