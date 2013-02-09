<?php

/**
 * app/Model/Report.php
 */
class Report extends AppModel {
    public $name = 'Report';
    //Models
    public function reportDates($type){
    	$day = 86400;
    	switch ($type) {
			case 'today':
				$date = date('D n/d/y');
				break;
			case 'yesterday':
				$date = strtotime(date('Y-m-d H:i:s'))-$day;
				$date = date('D n/d/y',$date);
				
				break;
			case 'thisWeek':
				$date ='Week '.date('W').'/52';
				break;
			case 'thisMonth':
				$date = date('F Y');
				break;
			case 'thisYear':
				$date = date('Y');
				break;
			case 'lastWeek':
				$date ='Week '.(date('W')-1).'/52';
				break;
			case 'lastMonth':
				$date = strtotime(date('Y-m-01 00:00:01'));
				$date = $date-$day;
				$date = date('F Y',$date);
				break;
			
			case 'lastYear':
				$date = date('Y')-1;
				break;

		}
		return $date;
	}    
  	
}

?>