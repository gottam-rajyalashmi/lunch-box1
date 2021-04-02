<div class="contailer-fluid">
	<h6>Projects Details</h6>
	<div class="row">
		<div class="col-md-6">
			<table class="table noborder">
				<tbody>
					<tr>
						<td width="150">Code</td>
						<td width="1%">:</td>
						<td><?=$projects['code'];?></td>
					</tr>
					<tr>
						<td width="150">Projects Name</td>
						<td width="1%">:</td>
						<td><?=$projects['name'];?></td>
					</tr>
					<tr>
						<td width="150">Role</td>
						<td width="1%">:</td>
						<td><?
							switch ($projects['role_id']) {
								case '1':
									echo "Super Admin";	break;
								case '2':
									echo "Admin";	break;
								case '3':
									echo "Employee";	break;
								default: echo " ";	break;
							}
						?></td>
					</tr>
					<tr>
						<td width="150">Priority</td>
						<td width="1%">:</td>
						<td><?=$projects['priority'];?></td>
					</tr>
					<tr>
						<td width="150">Start Date</td>
						<td width="1%">:</td>
						<td><?=$projects['start_at'];?></td>
					</tr>
					<tr>
						<td width="150">Target Date</td>
						<td width="1%">:</td>
						<td><?=$projects['end_at'];?></td>
					</tr>
					<tr>
						<td width="150">Responsible Person</td>
						<td width="1%">:</td>
						<td><?=$projects['responsible'];?></td>
					</tr>
					<tr>
						<td width="150">Assigned Person</td>
						<td width="1%">:</td>
						<td><?=$projects['assigned_to'];?></td>
					</tr>
					<tr>
						<td width="150">Description</td>
						<td width="1%">:</td>
						<td><?=$projects['description'];?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h5>Address</h5>
			<p>
				<? echo isset($projects['address1'])?$projects['address1']:'';?>,<br/>
				<? echo isset($projects['address2'])?$projects['address2']:'';?>,<br/>
				<? echo isset($projects['landmark'])?$projects['landmark']:'';?>,<br/>
				<? echo isset($projects['city'])?$projects['city']:'';?>,<br/>
				<? echo isset($projects['district'])?$projects['district']:'';?>,<br/>
				<? echo isset($projects['state'])?$projects['state']:'';?>,<br/>
				<? echo isset($projects['pincode'])?$projects['pincode']:'';?>.
			</p>
		</div>
	</div>
</div>
<style type="text/css">
	.noborder tbody tr td{
		border:0px;
	}
</style>