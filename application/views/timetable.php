<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
  <li class="active">Time Table</li>
</ol>

<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">

			<div class="panel-heading">
				Class
			</div>

			<div class="list-group">			
				<?php 
				if($classData) {
					$x = 1;
					foreach ($classData as $value) { 
					?>
						<a class="list-group-item classSideBar <?php if($x == 1) { echo 'active'; } ?>" onclick="getClassSection(<?php echo $value['class_id'] ?>)" id="classId<?php echo $value['class_id'] ?>">
				    		<?php echo $value['class_name']; ?>(<?php echo $value['numeric_name']; ?>)
					  	</a>	
					<?php 
					$x++;
					}
				} 
				else {
					?>
					<a class="list-group-item">No Data</a>
					<?php
				}		
				?>
			</div>

		</div>		
	</div>
	<!-- /col-md-4 -->

	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Time Table</div>

		  <div class="panel-body">		  
		  	<div class="result"></div>
            <div class="timetable"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /row -->

<script type="text/javascript" src="<?php echo base_url('custom/js/timetable.js') ?>"></script>