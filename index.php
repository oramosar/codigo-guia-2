<!DOCTYPE html>

<html lang="es">

<head>
	<title> HOJAS DE MEDIDAS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="main.css" rel="stylesheet">


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

	<script src="main.js"></script>

</head>

<body>
	<header>
		<div class="alert alert-info">
			<h2>Insertar Registros Denominaciones Billetes</h2>
		</div>
	</header>
	<section>

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">

				<tr class="info">
					<th>Denominacion</th>
					<th>Lote</th>
					<th>Edicion</th>
					<th>Proceso</th>
					<th>Pinza</th>
					<th>Contra pinza</th>
					<th>Registro</th>
					<th>Contra registro</th>

				</tr>
				<?php

				  while($registroBilletes = $queryBilletes->fetch_array( MYSQLI_BOTH))
				  {


				  echo '<tr>
				    	<td>'.$registroBilletes['id_denominacion'].'</td>
				    	<td>'.$registroBilletes['lote'].'</td>
				    	<td>'.$registroBilletes['edicion'].'</td>
				    	<td>'.$registroBilletes['proceso'].'</td>
				    	<td>'.$registroBilletes['pinza'].'</td>
				    	<td>'.$registroBilletes['contrapinza'].'</td>
				    	<td>'.$registroBilletes['registro'].'</td>
				    	<td>'.$registroBilletes['contraregistro'].'</td>
				    </tr>';
				   }

				  ?>


			</table>
		</div>

		<div class="text-center">
			<footer>
				<h3 class="text-center pad-basic no-btm">Agregar Nuevo Registro </h3>
			</footer>

		</div>

		<form>
			<div class="table-responsive">
				<table class="table bg-info" id="tabla">
					<tr class="fila-fija">
						<td>

							<div>
								<select required name="iddenominacion[]" id="option">
									<option value="">Denominacion</option>
									<option value="">2.000 NFB</option>
									<option value="">5.000 NFB</option>
									<option value="">10.000 NFB</option>
									<option value="">20.000 NFB</option>
									<option value="">50.000 NFB </option>
									<option value="">100.000 NFB</option>
								</select>
							</div>
						</td>
						<div>

							<td><input required name="lote[]" placeholder="Numero de Lote" /></td>
							<td><input required name="edicion[]" placeholder="Edicion" /></td>
							<td>

								<select required name="proceso[]" placeholder="Proceso" id="option" />
								<option value="">Proceso</option>
								<option value="">Blancas</option>
								<option value="">Fondos ANV</option>
								<option value="">Fondos REV</option>
								<option value="">Calcografia ANV</option>
								<option value="">Calcografia REV </option>
								</select>
							</td>
						</div>

						<td><input required name="pinza[]" placeholder="Pinza" /></td>
						<td><input required name="contrapinza[]" placeholder="Contrapinza" /></td>
						<td><input required name="registro[]" placeholder="Registro" /></td>
						<td><input required name="contraregistro[]" placeholder="Contraregistro" /></td>
						<td class="eliminar"><input type="button" value="Menos -" /></td>
					</tr>
				</table>
			</div>
			<div class="btn-der">
				<input type="submit" name="insertar" value="Insertar Dato" class="btn btn-info" />
				<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más + </button>

			</div>
		</form>

		<?php

				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))

				{


				$items1 = ($_POST['iddenominacion']);
				$items2 = ($_POST['lote']);
				$items3 = ($_POST['edicion']);
				$items4 = ($_POST['proceso']);
				$items5 = ($_POST['pinza']);
				$items6 = ($_POST['contrapinza']);
				$items7 = ($_POST['registro']);
				$items8 = ($_POST['contraregistro']);

				///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
				while(true) {

				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    $item2 = current($items2);
				    $item3 = current($items3);
				    $item4 = current($items4);
				    $item5 = current($items5);
				    $item6 = current($items6);
				    $item7 = current($items7);
				    $item8 = current($items8);

				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    $lot=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $edic=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $proce=(( $item4 !== false) ? $item4 : ", &nbsp;");
				    $pinz=(( $item5 !== false) ? $item5 : ", &nbsp;");
				    $contrap=(( $item6 !== false) ? $item6 : ", &nbsp;");
				    $regis=(( $item7 !== false) ? $item7 : ", &nbsp;");
				    $conreg=(( $item8 !== false) ? $item8 : ", &nbsp;");

				    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
				    $valores='('.$id.',"'.$lot.'","'.$edic.'","'.$proce.'","'.$pinz.'","'.$contrap.'","'.$regis.'","'.$conreg.'"),';

				    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
				    $valoresQ= substr($valores, 0, -1);

				    ///////// QUERY DE INSERCIÓN ////////////////////////////
				    $sql = "INSERT INTO alumnos (id_denominacion, lote, edicion, proceso, pinza, contrapinza, registro, contraregistro)
					VALUES $valoresQ";


					$sqlRes=$conexion->query($sql) or mysql_error();


				    // Up! Next Value
				    $item1 = next( $items1 );
				    $item2 = next( $items2 );
				    $item3 = next( $items3 );
				    $item4 = next( $items4 );
				    $item5 = next( $items5 );
				    $item6 = next( $items6 );
				    $item7 = next( $items7 );
				    $item8 = next( $items8 );

				    // Check terminator
				    if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false) break;

				          }

				}

			?>


	</section>


	<footer>
	</footer>

</body>

</html>

