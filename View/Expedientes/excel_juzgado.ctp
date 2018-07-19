<?php 
 App::uses('Sanitize', 'Utility');
  $tableHeaders=$this->Html->tableHeaders(
                array('#', 
                      '<i class="icon-file-alt"></i> Expediente',
                      '<i class="icon-legal"></i> Juzgado',
		      '<i class="icon-task"></i> Asunto',
		      'Cliente',
		      'CIS',
		      'Núm. Crédito',
		      'Cuantia del Juicio',
		      'Tipo de Gravamen',
		      'Garantía',
		      'Valor de la Garantía',
		      '<i class="icon-time"></i> Registro',
		      '<i class="icon-time"></i> Terminación',
		      '<i class="icon-time"></i> Notas'
		),array('')); 
?>
 <table id="example-datatables3" class="table table-striped table-bordered table-hover">
    <thead><?php echo $tableHeaders; ?></thead>
			<?php
			$e=1;
			$rows = array();
			//foreach ($expediente  as $menu):
                        foreach ($expediente as $expediente): 
       $notas=Sanitize::stripAll($expediente['Expediente']['notas']);
      //$rexp=$expediente['Expediente']['id'];
      //$nexpc1=substr($rexp, 4,-4); 
      //$nexpc2=substr($rexp, 8); 
    ?>
    <tr>
   	<td><?php echo $e; ?></td>
   	<td><?php echo $expediente['Expediente']['expediente']; ?></td>
        <td><?php echo $expediente['Juzgado']['organo_judicial']; ?></td>
        <td><?php echo $expediente['Materia']['descripcion']; ?></td>
        <td><?php echo $expediente['Cliente']['namefull']; ?></td>
        <td><?php echo $expediente['Expediente']['cis']; ?></td>
        <td><?php echo $expediente['Expediente']['num_credito']; ?></td>
        <td><?php echo $expediente['Expediente']['cuantia_juicio']; ?></td>
        <td><?php echo $expediente['Expediente']['tipo_gravamen']; ?></td>
        <td><?php echo $expediente['Expediente']['garantia']; ?></td>
        <td><?php echo $expediente['Expediente']['valor_garantia']; ?></td>
        <td><?php echo $expediente['Expediente']['fecha_registro']; ?></td>
        <td><?php echo $expediente['Expediente']['fecha_terminacion']; ?></td>
        <td><?php echo $notas; ?></td>
  </tr>
  <?php $e++; endforeach; ?>
 </table>
