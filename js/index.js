window.onload = function() {
	
	/* $Ajax("obtenerNuevosProductos.php", {
		onfinish: cargarPaneles,
		tipoRespuesta: $tipo.JSON,
		divCargando: "cargando",
		onerror: function(e) { alert(e) }
	}); */		

	// $("btnBuscar").onclick = enviarBusqueda;
	// $("listaCategorias").onchange = buscarCategoria;

	// Define el Droppable
	/* Droppables.add("listaCanasto", {
		onDrop: sueltaProducto,
		acccept: ["productoResultado", "deatalleFoto"]
	}); */
}

var panelCount;
var listaPanles;
// var listaResultados;

function cargarPaneles(lista) {
	// Apago el cartel de Loading
	$("cargando").hide();
	
	// Guardo la lista en una variable global
	// para posible uso futuro
	listaPaneles = lista;
	
	// Limpio la lista de resultados vieja
	$("panelContainer").innerHTML = "";

	// Itero entre los resultados
	for (var i=0; i<lista.length; i++) {
		
		agregarPanel(lista[i]);
		panelCount = i+1;
	}
	


}	


function agregarPanel(producto) {

	var divcontent = $("main-photo-slider").innerHTML;

	alert(divcontent);

	var div = document.createElement("div");
	div.className = 'panel';
	div.id ='producto' + producto.id;
	div.title = 'Panel 1';
	// .innerHTML += "<div title='Panel " + panelCount + "'>";
	div.innerHTML += "<img src='images/" + producto.caratula + ".jpg' alt='temp' />";
	div.innerHTML += "<div class='photo-meta-data'>";
	div.innerHTML += "&quot;" + producto.titulo + " de " + producto.artista + "<br />";
	div.innerHTML += "<span>" + producto.descripcion + "</span>";
	div.innerHTML += "</div>";
	div.innerHTML += "</div>";
	// .innerHTML += "</div>";
	$("panelContainer") .appendChild(div);

}
	
/* function enviarBusqueda() {
	$Ajax("buscar.php?palabra=" + $F("textoBusqueda"), {
		onfinish: cargarResultados,
		tipoRespuesta: $tipo.JSON,
		divCargando: "cargando" 
	});
}	

function buscarCategoria() {
	$Ajax ("categoria.php?id=" + $F("listaCategorias"), {
		onfinish: cargarResultados,
		tipoRespuesta: $tipo.JSON,
		divCargando: "cargando"
	}); 
} 

var listaResultados;

function cargarResultados(lista) {
	// Apago el cartel de Loading
	$("cargando").hide();
	// Guardo la lista en una variable global
	// para posible uso futuro
	listaResultados = lista;
	
	// Limpio la lista de resultados vieja
	$("listaResultados").innerHTML = "";

	// Itero entre los resultados
	for (var i=0; i<lista.length; i++) {
		agregarResultado(lista[i]);
	}
}

// Hash de productos previamente navegados
var cacheProductos = [];

function agregarResultado(producto) {
	var div = document.createElement("div");
	div.className = 'productoResultado';
	div.id ='producto' + producto.id;
	div.innerHTML += "<div class='nombreProducto' onclick='detalle(" + producto.id + ")'>" + producto.nombre + "</div>";
	div.innerHTML += "<div class='precioProducto'>$ " + producto.precio +"</div>";
	div.innerHTML += "<div class='agregarProducto' onclick='agregar(" + producto.id + ")'>Agregar</div>";
	$("listaResultados") .appendChild(div);

	// Agregamos el producto al hash
	cacheProductos[producto.id] = {
		nombre: producto.nombre,
		precio: producto.precio,
		// Definimos el producto como Draggable
		drag: new Draggable("producto" + producto . id, { revert: true})
	}
}	
		
function detalle(id) {
	//Tengo que ir a buscar al servidor los detalles del producto
	$Ajax("producto.php?id=" + id, {
		onfinish: mostrarDetalle,
		tipoRespuesta: $tipo.JSON,
		avisoCargando: "cargando",
		cache: true
	})
}


function mostrarDetalle(producto) {
	// Creo el contenido de la zona de Detalle
	var html = "<div class='detalleNombre'>" + producto.nombre + "</div>";
	if (producto.foto != "") {
		// Si tiene foto , la incluimos
		html += "<img src='fotos/'" + producto.foto + "' class='detalleFoto' id='foto" + producto.id + "' />";
	}	
		html += "<input type='button' class='detalleAgregar' value='Agregar al Canasto' " +
                "onclick='agregar(" + producto.id + ")' />";
		html += "<div class='detalleCategoria'>Categoria : " + producto.categoria + "</div>";
		html += "<div class='detallePrecio'>Precio : $" + producto.precio + "</div>";
		html += "<div class='detalleDescripcion'>q " + producto.descripcion + "</div>";
		$("listaDetalle").innerHTML = html;
		new Draggable("foto" + producto.id, {revert: true});
}		

// Vector global del canasto de compras
var canasto = [];

// Agrega un producto al canasto de compras
function agregar(id) {
	// Primero buscamos si el producto ya estaba en e l canasto
	var i=0;
	var encontrado = false;
		while ((i<canasto.length) && (!encontrado))	{
			if (canasto[i].id == id) {
				encontrado = true;
			} else {
				i++;
			}
		}
				
		if (encontrado) {
			// El producto ya estaba en el canasto, sólo aumentamos
			// su cantidad. "i" tiene la posición actual
			canasto[i].cantidad++;
		} else {
			// El producto no estaba en el canasto, lo agregamos
			// obtenemos los datos del producto desde el hash global
			var producto = cacheProductos[id];
			nuevoProducto = {
				'id': id,
				'nombre': producto.nombre,
				'precio': producto.precio,
				'cantidad': 1
			};
			canasto[canasto.length] = nuevoProducto;
		}
		//Llama a la función que dibuja el canasto
		actualizarCanasto();
}			


//Dibuja el canasto en la zona especificada
function actualizarCanasto() {
	// Primero creamos la lista de productos
	var contenido = "";
	if (canasto.length==0) {
		contenido = "El canasto está vacío. <br />" ;
	} else {
		var filaCanasto;
		var total = 0;
		for (var i=0; i<canasto.length; i++) {
			// Creo una fila por cada producto
			filaCanasto = "<div class='filaCanasto' ";
			filaCanasto +=" id='canasto_" + canasto[i].id + "'>";
			// Armamos cada fila con una tabla
			var tablaCanasto;
			tablaCanasto = "<table width='100%'><tr>" ;
			tablaCanasto += "<td class='canastoNombre'>" + canasto[i].nombre + "</td>";
			tablaCanasto += "<td class='canastoCantidad'>Cant: " + canasto[i].cantidad + 
							"<img src='flechaup.gif' onClick='subir(" + canasto[i].id + ")' />" +
							"<img src='flechadown.gif' onClick='bajar(" + canasto[i].id + ")' /></td>";
			tablaCanasto += "<td class='canastoPrecio'>$" + canasto[i].cantidad*canasto[i].precio + "</td>";
			tablaCanasto += "<td><a href='javascript: quitar(" + canasto[i].id + ")' class='canastoQuitar'>Quitar</a></td>";
			tablaCanasto += "</tr></table>";
			filaCanasto += tablaCanasto + "</div>";
			contenido += filaCanasto;
			total += canasto[i].precio * canasto[i].cantidad;
		}
		
		// Mostramos el TOTAL
		contenido += generarFilaTotal(total);

		// Agregamos el botón para Finalizar la Compra
		contenido += "<input type='button' id='btnFinalizar' value='Finalizar Compra' />";
		
	}
	$("listaCanasto").innerHTML = contenido;

	// Agrego todas las filas del canasto como Draggables
	for (var i=0; i<canasto.length; i++) {
		new Draggable ("canasto_" + canasto[i].id, {revert: true});
	}	

	// Creamos el bote de basura
	var bote = document.createElement("img");
	bote.src = "basura.png";
	bote.width = "100";
	bote.height = "100";
	bote.id = "basura";
	$("listaCanasto").appendChild(bote);
	// Creo la zona de Drop con el bote
	Droppables.add("basura" , {
		accept:'filaCanasto',
		onDrop: tiraProducto
	});

	$("btnFinalizar").onclick = finalizar;
}

function generarFilaTotal(total) {
	var filaCanasto = "<div class='totalCanasto'>";
	var tablaCanasto;
	tablaCanasto = "<table width='100%'><tr>";
	tablaCanasto += "<td class='canastoNombre'>TOTAL</td>";
	tablaCanasto += "<td class='canastoCantidad'></td>";
	tablaCanasto += "<td class='canastoPrecio'>$" + total + "</td>";
	tablaCanasto += "<td><a href='javascript: vaciar()' class='canastoQuitar'>Vaciar</a></td>";
	tablaCanasto += "</tr></table>";
	filaCanasto += tablaCanasto + "</div>";
	return filaCanasto;
}	

// Quita un producto del canasto
function quitar(id) {
	// Primero buscamos si el producto ya estaba en el canasto
	var i=0;
	var encontrado = false;
	while ((i<canasto.length) && (!encontrado)) {
		if (canasto[i].id == id) {
			encontrado = true;
			// Lo eliminamos de la lista con Prototype
			canasto = canasto.without(canasto[i]);
		} else {
			i++;
		}
	}		
	actualizarCanasto();
}
	
// Vacía todo el canasto
function vaciar() {
	canasto = [];
	actualizarCanasto();
}	


// Sube la cantidad de un producto del canasto
function subir(id) {
	// Primero buscamos el producto
	var i=0;
	var encontrado = false;
	while ((i<canasto.length) && (!encontrado)) {
		if (canasto[i].id == id) {
			encontrado = true;
			//Lo eliminamos de la lista con Prototype
			canasto[i].cantidad++;
		} else {
			i++;
		}
	}		
	actualizarCanasto();
}

// Baja la cantidad de un producto del canasto
function bajar(id) {
	// Primero buscamos el producto
	var i =0;
	var encontrado = false ;
	while ((i<canasto.length) && ( !encontrado)) {
		if (canasto[i].id == id) {
			encontrado = true;
			// Lo eliminamos de la lista con Prototype
			canasto[i].cantidad--;
			// Si quedó en cero, quitamos el producto
			if (canasto[i].cantidad==0) {
				quitar(id);
			}	
		} else {
			i++;
		}
	}
	actualizarCanasto();
}	

// Se ejecuta cuando el usuario suelta un producto en el canasto
function sueltaProducto(drag, drop, evento) {
	// Obtenemos el ID
	var id;
	if (drag.id.substring(0, 8) == "producto") {
		// Obtenemos el ID, es productoXXX
		id = drag.id.substring(8, drag.id.length);
	} else {
		id = drag.id.substring(4, drag.id.length);
	}
	// Agregamos el producto al canasto
	agregar(id);
	// Hacemos un efecto sobre el canasto
	// Para que el usuario vea la donfirmación de su Drop
	new Effect.Appear('listaCanasto', {duration: 0.2});
}

function tiraProducto(drag,drop,evento) {
	var id = drag.id.substring(8, drag.id.length);
	quitar(id);
}

// Muestra el formulario de Finalización de Compra
function finalizar() {
	$("ventanaModal").style.visibility = "visible";
}	

// Cancela el envío de la compra
function cancelar() {
	$("ventanaModal").style.visibility = "hidden";
}	


// Envía toda la información del pedido
function enviar() {
	// TODO : Validaciones
	// Armamos un string de tipo QueryString con los datos personales
	var parametros = "";
	parametros += "nomyape=" + $F("txtNombre");
	parametros += "&direccion=" + $F("txtDireccion");
	parametros += "&telefono=" + $F("txtTelefono");

	// Recorremos todo el canasto y armamos un string con los ID y las cantidades
	var strCarrito = "";
	for (var i=0; i<canasto.length; i++) {
		strCarrito += canasto[i].id;
		// Para separar ID de Cantidad usamos un guion
		strCarrito += "-";
		strCarrito += canasto[i].cantidad;
		// Usamos punto para separar productos
		strCarrito += ".";
	}	
	// Eliminamos último pipe
	strCarrito = strCarrito.substring(0, strCarrito.length-1);
	parametros += "&carrito=" + strCarrito;

	$Ajax("enviar.php", {
		metodo: $metodo.POST,
		parametros: parametros,
		avisoCargando : "cargando",
		onfinish: function() {
			alert("Su pedido ha sido guardado");
			cancelar() ;
			vaciar();
		}
	});
}		*/