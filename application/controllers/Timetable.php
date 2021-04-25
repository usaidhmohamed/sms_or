<?php 	

class Timetable extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// $this->isNotLoggedIn();

		// loading the section model
		$this->load->model('model_subject');
		// loading the classes model
		$this->load->model('model_classes');
		// loading the teacher model
		$this->load->model('model_teacher');

		// loading the form validation library
		$this->load->library('form_validation');		
	}

	/*
	*----------------------------------------------
	* fetches the class's section table 
	*----------------------------------------------
	*/
	public function fetchSubjectTable($classId = null)
	{
		if($classId) {
			$subjectData = $this->model_subject->fetchSubjectDataByClass($classId);
			$classData = $this->model_classes->fetchClassData($classId);
			
			$table = '

			<div class="well">
				Class Name : '.$classData['class_name'].'
			</div>

			<div id="messages"></div>
		  		
		  	<br /> <br />

		  	<!-- Table -->
		  	<table class="table table-bordered" id="manageSubjectTable">
			    <thead>	
			    	<tr>
			    		<th> Subject Name </th>			    		
			    		<th> Teacher Name  </th>
			    	</tr>
			    </thead>
			    <tbody>';
			    	if($subjectData) {
			    		foreach ($subjectData as $key => $value) {

			    			$teacherData = $this->model_teacher->fetchTeacherData($value['teacher_id']);

				    		$table .= '<tr>
				    			<td>'.$value['name'].'</td>				    			
				    			<td>'.$teacherData['fname'].' '.$teacherData['lname'].'</td>
				    		</tr>
				    		';
				    	} // /foreach				    	
			    	} 
			    	else {
			    		$table .= '<tr>
			    			<td colspan="3"><center>No Data Available</center></td>
			    		</tr>';
			    	} // /else
			    $table .= '</tbody>
			</table>
			';
			echo $table;
		}
	}

    public function fetchTimeTable($classId = null) {
        $allSubjectData = $this->model_subject->fetchAllSubject();
        $numberOfPeriods = 4;
        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday') ;
        $uniquePeriodSubjects = array();
        for ($i=0; $i < 5; $i++) {
            $uniquePeriodSubjects = array_merge($uniquePeriodSubjects, $allSubjectData);
        };

        foreach ($uniquePeriodSubjects as $key => $value) {
            $period = ($key % $numberOfPeriods) + 1;
            $day = $days[floor($key / 4) % 5];
            $value['period'] = $period;
            $value['day'] = $day;
            $value['key'] = $key;
            $uniquePeriodSubjects[$key] = $value;
        };
        
        $uniquePeriodSubjects = array_values(array_filter($uniquePeriodSubjects, function($var) use ($classId){
            if ($var['class_id'] == $classId) {
                return $var;
            }
        }));
    
        $table = '
        <!-- Table -->
		  	<table class="table table-bordered" id="manageSubjectTable">
			    <thead>	
			    	<tr>
			    		<th> Subject</th>			    		
			    		<th> Period</th>
                        <th> Day</th>
                        <th> Key</th>
			    	</tr>
			    </thead>
			    <tbody>';
			    	if($uniquePeriodSubjects) {
			    		foreach ($uniquePeriodSubjects as $key => $value) {

			    			$teacherData = $this->model_teacher->fetchTeacherData($value['teacher_id']);
                            $classData = $this->model_classes->fetchClassData($value['class_id']);

				    		$table .= '<tr>
                                <td>'.$value['name'].'</td>				    			
				    			<td>'.$value['period'].'</td>
                                <td>'.$value['day'].'</td>
                                <td>'.$value['key'].'</td>
				    		</tr>
				    		';
				    	} // /foreach				    	
			    	} 
			    	else {
			    		$table .= '<tr>
			    			<td colspan="3"><center>No Data Available</center></td>
			    		</tr>';
			    	} // /else
			    $table .= '</tbody>
			</table>';

        echo $table;
    }

}