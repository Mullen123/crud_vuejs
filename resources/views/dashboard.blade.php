@extends('app')

@section('content')

<div id="crud" class="row">

	<div>
		<h1 >CRUD Laravel y VUEjs</h1>
	</div><br>
	<div class="col-md-12">

		<a href="#" class="btn btn-primary " data-toggle="modal" data-target="#create">
			Nueva tarea
		</a><!--#create hace alusion a la visa que se desplegara-->
	</div>
	<div class="col-md-12">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tarea</th>
					<th colspan="2">
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody>
				<!--para mostrar los datos que trae keeps(array de todos los datos)-->
				<tr v-for="keep in keeps">
					<td>@{{keep.id}}</td>
					<td>@{{keep.keep}}</td>
					<td width="10px">
						<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click.prevent="editKeep(keep)">
			Editar
		</a><!--#create hace alusion a la visa que se desplegara-->
					</td>
					<td width="10px">
						<!--se le pasa  la variable keep por que es un registro-->
						<a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteKeep(keep)">Eliminar</a>
					</td>
				</tr>
			</tbody>
		</table>



	<!--agregamos botones de paginacion-->

	<nav>
			<ul class="pagination">
				<li v-if="pagination.current_page > 1">
					<a href="#" @click.prevent="changePage(pagination.current_page - 1)">
						<span>Atras</span>
					</a>
				</li>

				<li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
					<a href="#" @click.prevent="changePage(page)">
						@{{ page }}
					</a>
				</li>

				<li v-if="pagination.current_page < pagination.last_page">
					<a href="#" @click.prevent="changePage(pagination.current_page + 1)">
						<span>Siguiente</span>
					</a>
				</li>
			</ul>
		</nav>

		<!--se usa el codgio de la vista create-->
		@include('create')
		<!--se incluye el codigo de la vista edit-->
			@include('edit')

	</div>

	




</div>
@endsection