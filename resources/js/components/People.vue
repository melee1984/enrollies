
<template>

	<div>
		<div class="jumbotron">
			<h1>Board Passer</h1>
			<p class="lead">Please find the list below</p>
			<a class="btn btn-lg btn-primary" v-on:click="updateList" role="button">Click here to update list</a>
		</div>

		<ul class="nav nav-tabs">
  			<li class="active"><a data-toggle="tab" href="#board" class="active">Board Passer</a></li>
  			<li><a data-toggle="tab" href="#school">School</a></li>
  			<li><a data-toggle="tab" href="#new-examinee">New Examinee</a></li>
		</ul>

		<div class="tab-content">
			
			<div id="board" class="tab-pane fade in active">
				<h3></h3>

				<div class="form-group">
    				<label for="exampleInputEmail1">Search</label>
			    	<input type="email" class="form-control" id="seach" name="seach"  v-model="search"  placeholder="Search" @change="searchFilter">
			    	<small id="emailHelp" class="form-text text-muted">Search filter based on the fields available</small>
			  	</div>

				<table class="table table-hover dataTable">
					<thead>
						<tr>
							<td>Fullname</td>
							<td>Campus Eligibility</td>
							<td>School</td>
							<td>Division</td>
						</tr>
					</thead>
					<tbody>
					

						<tr v-for="list in boardPasser.data">
							<td width="40">{{ list.fullname }}</td>
							<td width="20">{{ list.campus_eligibility }}</td>
							<td width="20">{{ list.school['school_name'] }}</td>
							<td width="20">{{ list.division }}</td>
						</tr>
							
					</tbody>

					<tfoot>
						<tr>
							<td colspan="4">
								<pagination :data="boardPasser" v-on:pagination-change-page="pageClick"></pagination>
							</td>
						</tr>
					</tfoot>


				</table>
			</div>

			<div id="school" class="tab-pane fade">
				<h3>School</h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Campus</th>
							<th>No#</th>
						</tr>
					</thead>
					<tbody>

						<tr v-if="loading">
							<td>Please wait while updating content</td>
						</tr>

						<tr v-for="list in schoolTop" >
							<td>{{ list.school }}</td>
							<td>{{ list.total }}</td>
						</tr>


					</tbody>

					
				</table>


			</div>

			<div id="new-examinee" class="tab-pane fade">


				<div class="form-upload-card" v-if="addExamineeForm">
					<div class="jumbotron">
						<h4 class="display-10">Add Examinee</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
						            <label for="exampleInputEmail1">Fullname</label>
						            <input type="text"class="form-control"  name="name" id="name"   v-model="fields.name" placeholder="Lastname Middlename, Firstname"/>
									<small id="emailHelp" class="form-text text-muted">Text Format: Lastname Middlename, Firstname</small>
					            </div>
					            <div class="form-group">
					              	<label for="exampleInputEmail1">School</label>
						            <input type="text" class="form-control" name="school" id="school"  v-model="fields.school"  />
					            </div>
					            <input type="submit" class="btn btn-default btn-sm" value="Add Record" v-on:click="submitRecord()" />
					            <input type="button" class="btn btn-default btn-sm" value="Close" v-on:click="closeExaminee()" />
							</div> 

							<div class="col-md-6">
								&nbsp;
							</div>

						</div>
					</div>
				</div>


				<h3>New Examinee</h3>

				<a class="btn btn-lg btn-primary" v-on:click="addExaminee" role="button">Add Examinee</a>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>School</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="loading">
							<td>Please wait while updating content</td>
						</tr>

						<tr v-for="list in examinee" >
							<td>{{ list.fullname }}</td>
							<td>{{ list.school }}</td>
						</tr>

					</tbody>
				</table>
			</div>

		</div>
	</div>

</template>


<script>
	export default {
		data() {
			return {
				
				fields: {},
      			errors: {},
      			search: null,
				boardPasser: [],
				schoolTop: [],	
				examinee: [],	
				loading: true,
				loadingExaminee: true,
				addExamineeForm: false,
			}
		},
		created() {
			this.fetchRecord();
		},
		methods: {
			fetchRecord: function() {

				var self = this;

				axios.get('/board/passer')
                    .then(function (response) {
                        self.boardPasser = response.data.boardPasser;
                        self.schoolTop = response.data.topSchool;
                        self.examinee =  response.data.examinee;
                        self.loading = false;
                        self.loadingExaminee = false;
                })
                .catch(function (error) {
                    console.log(error);
                });

			},

			pageClick: function(page = 1) {

				var self = this;

				if (typeof page === 'undefined') {
					page = 1;
				}

				axios.get('/board/passer?page='+page)
                    .then(function (response) {
                        self.boardPasser = response.data.boardPasser;
                        self.schoolTop = response.data.topSchool;
                        self.examinee =  response.data.examinee;
                        self.loading = false;
                        self.loadingExaminee = false;
                })
                .catch(function (error) {
                    console.log(error);
                });

			},

			searchFilter: function() {

				var self = this;

				axios.get('/board/passer?search='+self.search)
                    .then(function (response) {
                        self.boardPasser = response.data.boardPasser;
                        self.schoolTop = response.data.topSchool;
                        self.examinee =  response.data.examinee;
                        self.loading = false;
                        self.loadingExaminee = false;
                })
                .catch(function (error) {
                    console.log(error);
                });

			},



			updateList: function() {

				var self = this;
				self.loading = true;
				self.boardPasser = [];
				self.schoolTop = [];

				axios.get('/process')
                    .then(function (response) {
                        self.boardPasser = response.data.boardPasser;
                        self.schoolTop = response.data.topSchool;
						self.examinee =  response.data.examinee;
						self.loading = false;
						self.loadingExaminee = false;



                })
                .catch(function (error) {
                    console.log(error);
                });

			},
			addExaminee: function() {
				var self = this;

				self.addExamineeForm = true;
				selft.loadingExaminee = true;
			},
			submitRecord: function() {
				var self = this;
				
				self.errors = {};
				self.loadingExaminee = true;

				axios.post('/examinee/add/submit', self.fields).then(response => {
			        
			        self.examinee =  response.data.examinee;
			        
			        self.loadingExaminee = false;
			        self.addExamineeForm = false;

			     }).catch(error => {
			        if (error.response.status === 422) {
			          self.errors = error.response.data.errors || {};
			        }
			        else {

			        }
			     });
			},
			closeExaminee: function() {
				var self = this;

				self.addExamineeForm = false;
			}
		}
	}
</script>

