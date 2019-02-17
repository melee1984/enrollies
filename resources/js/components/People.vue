<template>

	<div>
		<div class="jumbotron">
			<h1>Board Passer</h1>
			<p class="lead">Please find the list below</p>
			<a class="btn btn-lg btn-primary" href="/docs/4.3/components/navbar/" role="button">Click here to update list</a>
		</div>

		<ul class="nav nav-tabs">
  			<li class="active"><a data-toggle="tab" href="#board" class="active">Board Passer</a></li>
  			<li><a data-toggle="tab" href="#school">School</a></li>
  				<li><a data-toggle="tab" href="#new-examinee">New Examinee</a></li>
		</ul>

		<div class="tab-content">
			
			<div id="board" class="tab-pane fade in active">
				<h3></h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>Campus Eligibility</th>
							<th>School</th>
							<th>Division</th>
						</tr>
					</thead>
					<tbody>
							
							<tr v-for="list in boardPasser">
								<td width="40">{{ list.fullname }}</td>
								<td width="20">{{ list.ce }}</td>
								<td width="20">{{ list.school }}</td>
								<td width="20">{{ list.division }}</td>
							</tr>
							
					</tbody>
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
						<tr v-for="list in schoolTop" >
							<td>{{ list.school }}</td>
							<td>{{ list.total }}</td>
						</tr>

					</tbody>
				</table>
			</div>

			<div id="new-examinee" class="tab-pane fade">
				<h3>New Examinee</h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>School</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Parba, Leslie Candelaria</td>
							<td>STI</td>
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
				boardPasser: [],
				schoolTop: [],				
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
                })
                .catch(function (error) {
                    console.log(error);
                });

			},
		}
	}
</script>

