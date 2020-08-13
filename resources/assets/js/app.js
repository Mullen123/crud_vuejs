

new Vue({
		//es el id del contenedor principal
			el: '#crud',
			data:{
				//arreglo donde se encapsulan todos los datos
				keeps:[],
				//paginacion
				pagination:{
				'total' :0,
                'current_page':0, 
                'per_page' :0,
                'last_page' :0,
                'from' :0,
                'to' :0

				},










				//se dan de alta las variables que se 
				newKeep:'',
				//creas variable fill keep que se usa para la edicon
			fillKeep: {'id': '', 'keep': ''},
				//Se da de alta la variable que muestra el error
				errors: '',
			},
			//ejecuta el metodo getkeeps
			created:function(){
				this.getKeeps();
			}
			,
			
			computed: {
		isActived: function() {
			return this.pagination.current_page;
		},
		pagesNumber: function() {
			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset; 
			if(from < 1){
				from = 1;
			}

			var to = from + (this.offset * 2); 
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		}
	},
			methods:{
				//metodo que optiene todas las tareas //si le quitas page 
				getKeeps:function(page){
					//esto es para la paginacion
						var urlKeeps = 'tasks?page='+page;
					//ruta del controller funcion  index se puede ver en route list

					var url = urlKeeps = 'tasks';
					axios.get(urlKeeps).then(response =>{

						//si es correcto entoces traes lo que tenga data y lo asignamos
						//en keeps
						//this.keeps = response.data

						//para mostrar los datos paginados
						this.keeps = response.data.tasks.data,
						this.pagination = response.data.pagination
					});	
			
					},
					//metodo que elimina las tareas
					deleteKeep:function(keep){
						//la url vista en route list  es tasks contcatenado el id
						//por tal motivo se pone de esa forma 
						var url = 'tasks/' + keep.id;


						//hacemos uso de axios para las peticiones ajax
						//se elimina el registro
						axios.delete(url).then(response =>{//eliminamos

							//se listan de nuevo los elementos sin los eliminados
							this.getKeeps();//
							//aqui va el mensaje de notificacion de que se elimino ese pedo
							toastr.success('Eliminado correctamente');
						});

					},
					//metodo para guardar en la base de datos
				createKeep: function() {
			var url = 'tasks';
			axios.post(url, {
				keep: this.newKeep
			}).then(response => {
				this.getKeeps();
				this.newKeep = '';
				this.errors = [];
				
				toastr.success('Nueva tarea creada con éxito');
			})

		},
		editKeep: function(keep) {
			this.fillKeep.id   = keep.id;
			this.fillKeep.keep = keep.keep;
		
		},
		
		 updateKeep: function(id) {
			var url = 'tasks/' + id;
			axios.put(url, this.fillKeep).then(response => {
				this.getKeeps();
				this.fillKeep = {'id': '', 'keep': ''};
				this.errors	  = [];
				
				toastr.success('Tarea actualizada con éxito');
			}).catch(error => {
				this.errors = 'Corrija para poder editar con éxito'
			});
		},
		changePage: function(page) {
			this.pagination.current_page = page;
			this.getKeeps(page);
		}
		

		



			}//terminan los metodos
		
		});