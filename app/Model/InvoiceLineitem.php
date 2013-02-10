<?php
App::uses('AppModel', 'Model');
/**
 * InvoiceLineitem Model
 *
 */
class InvoiceLineitem extends AppModel {
	public $name = 'InvoiceLineitem';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'invoice_number' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'company_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantity' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'before_tax' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'after_tax' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
/**
 * salesData method
 * @param type, array, id
 * @return array
 */
	public function salesData($type, $category, $company_id)
	{
		//find all the different categories
		$category_count = count($category);
		
		switch ($type) {
			case 'Today':
				//create short variables
				$start = date('Y-m-d').' 00:00:00';
				$end = date('Y-m-d').' 23:59:59';
				$todayArray = array();
				$idx = -1;
				foreach ($category as $c) {
					$idx = $idx+1;
					$category_name = $c['Category']['name'];
					$category_id = $c['Category']['id'];
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category_name.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');	
										 
					foreach ($sum as $s) {
						$total = $s[0]['sumAfterTax'];
					}		
					if($total > 0){
						$total = sprintf('%.2f',round($total,2));	
					} else {
						$total ='0.00';
					}	
					
					$todayArray[$idx] = array(
						'name'=>$category_name,
						'total'=>$total,
						'start'=>$start,
						'end'=>$end
					);	
				}

				
				return $todayArray;

				
				break;
			case 'Yesterday':
				//create short variables
				$start = date('Y-m-d',(strtotime(date('Y-m-d H:i:s')))-86400).' 00:00:00';
				$end = date('Y-m-d',(strtotime(date('Y-m-d H:i:s')))-86400).' 23:59:59';
				$todayArray = array();
				for ($i=0; $i < $category_count; $i++) { 
					$category_name = $category[$i]['Category']['name'];
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category_name.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					

					if(count($sum)>0){
						foreach ($sum as $s) {
							$total = $s[0]['sumAfterTax'];
						}
					} else {
						$total = 0;
					}
					if($total > 0){
						$total = number_format(round($total,2),2);	
					} else {
						$total = '0.00';
					}
					
					$todayArray[$i] = array('name'=>$category_name,'total'=>$total);
				}
				
				return $todayArray;

				
				break;
			case 'Daily':
				$start = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									   ORDER BY `Invoice_lineitem`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice_lineitem']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									 ORDER BY `Invoice_lineitem`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice_lineitem']['created']);
						$endTime = date('Y-m-d',$endTime).' 23:59:59';
						$endTime = strtotime($endTime);
					}
				} else {
					$endTime = 1;
				}
				$total_days = ceil(($endTime-$startTime)/86400);
				if ($total_days ==0) {
					$total_days =1;
				}
				
				
				
				$countOfDays = 0;
				
				for ($i=0; $i < $total_days; $i++) {
					$nextDay = $i*86400; 
					$begin = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 00:00:00';
					$finish = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 23:59:59';
					$findNoZero = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS findNoZero FROM invoice_lineitems AS Invoice_lineitem
											 	WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
											 	AND `Invoice_lineitem`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
					foreach ($findNoZero as $rowZero) {
						$totalNoZero = $rowZero[0]['findNoZero'];
					}
					if($totalNoZero>0){
						$plusDay = 1;	
					} else {
						$plusDay = 0;
					}
					$countOfDays = $countOfDays + $plusDay;
				}
				//parse through each different category and get the average amount
				$todayArray = array();
				for ($i=0; $i < $category_count; $i++) { 
					$category_name = $category[$i]['Category']['name'];
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category_name.'"');
					$total = $sum[0][0]['sumAfterTax'];
					if($total > 0){
						$total = number_format(round($sum[0][0]['sumAfterTax']/$countOfDays,2),2);	
					} else {
						$total = '0.00';
					}
					
					$dailyArray[$i] = array('name'=>$category_name,'total'=>$total);
				}

			
				return $dailyArray;		
				break;
			
			case 'DayAvg':
				$day = date('l');
	
				$start = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									   AND `Invoice_lineitem`.`day_paid` = "'.$day.'" 
									   ORDER BY `Invoice_lineitem`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice_lineitem']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									 AND `Invoice_lineitem`.`day_paid` = "'.$day.'"
									 ORDER BY `Invoice_lineitem`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice_lineitem']['created']);
						$endTime = date('Y-m-d',$endTime).' 23:59:59';
						$endTime = strtotime($endTime);
					}
				} else {
					$endTime = 1;
				}
				$total_days = ceil(($endTime-$startTime)/86400);
				if ($total_days ==0) {
					$total_days =1;
				}
				$countOfDays = 0;
				for ($i=0; $i < $total_days; $i++) {
					$nextDay = $i*86400; 
					$begin = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 00:00:00';
					$finish = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 23:59:59';
					$findNoZero = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS findNoZero FROM invoice_lineitems AS Invoice_lineitem
											 	WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
											 	AND `Invoice_lineitem`.`day_paid` = "'.$day.'"
											 	AND `Invoice_lineitem`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
					foreach ($findNoZero as $rowZero) {
						$totalNoZero = $rowZero[0]['findNoZero'];
					}
					if($totalNoZero>0){
						$plusDay = 1;	
					} else {
						$plusDay = 0;
					}
					$countOfDays = $countOfDays + $plusDay;
				}

				//parse through each different category and get the average amount
				$todayArray = array();
				for ($i=0; $i < $category_count; $i++) { 
					$category_name = $category[$i]['Category']['name'];
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category_name.'"
										 AND `Invoice_lineitem`.`day_paid` = "'.$day.'"');
					$total = $sum[0][0]['sumAfterTax'];
					if($total > 0){
						$total = number_format(round($sum[0][0]['sumAfterTax']/$countOfDays,2),2);	
					} else {
						$total = '0.00';
					}
				
					$dayArray[$i] = array('name'=>$category_name,'total'=>$total);
				}

			
				return $dayArray;					
				break;
			case 'YesterdayDayAvg':
				$day = date('l',(strtotime(date('Y-m-d H:i:s'))-86400));
	
				$start = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									   AND `Invoice_lineitem`.`day_paid` = "'.$day.'" 
									   ORDER BY `Invoice_lineitem`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice_lineitem']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									 AND `Invoice_lineitem`.`day_paid` = "'.$day.'"
									 ORDER BY `Invoice_lineitem`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice_lineitem']['created']);
						$endTime = date('Y-m-d',$endTime).' 23:59:59';
						$endTime = strtotime($endTime);
					}
				} else {
					$endTime = 1;
				}
				$total_days = ceil(($endTime-$startTime)/86400);
				if ($total_days ==0) {
					$total_days =1;
				}
				$countOfDays = 0;
				for ($i=0; $i < $total_days; $i++) {
					$nextDay = $i*86400; 
					$begin = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 00:00:00';
					$finish = date('Y-m-',$startTime).date('d',$startTime+$nextDay).' 23:59:59';
					$findNoZero = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS findNoZero FROM invoice_lineitems AS Invoice_lineitem
											 	WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
											 	AND `Invoice_lineitem`.`day_paid` = "'.$day.'"
											 	AND `Invoice_lineitem`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
					foreach ($findNoZero as $rowZero) {
						$totalNoZero = $rowZero[0]['findNoZero'];
					}
					if($totalNoZero>0){
						$plusDay = 1;	
					} else {
						$plusDay = 0;
					}
					$countOfDays = $countOfDays + $plusDay;
				}

				//parse through each different category and get the average amount
				$todayArray = array();
				for ($i=0; $i < $category_count; $i++) { 
					$category_name = $category[$i]['Category']['name'];
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category_name.'"
										 AND `Invoice_lineitem`.`day_paid` = "'.$day.'"');
					$total = $sum[0][0]['sumAfterTax'];
					if($total > 0){
						$total = number_format(round($sum[0][0]['sumAfterTax']/$countOfDays,2),2);	
					} else {
						$total = '0.00';
					}
				
					$dayArray[$i] = array('name'=>$category_name,'total'=>$total);
				}

			
				return $dayArray;					
				break;				

			case 'yearByMonth':
				
				$monthArray = array();
				for ($i=1; $i < 13; $i++) { 
					$startMonth = date('Y-').$i.'-01 00:00:00';	
					$endMonth = date('Y-').$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');
					$total = $sum[0][0]['sumAfterTax'];	
					if($total == ''){
						$total = '0.00';
					}
					$monthArray[$i] = array('value'=>$total);				
				}
				return $monthArray;
				
				
				break;	
			case 'lastYearByMonth':
				
				$monthArray = array();
				for ($i=1; $i < 13; $i++) { 
					$startMonth = (date('Y')-1).'-'.$i.'-01 00:00:00';	
					$endMonth = (date('Y')-1).'-'.$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');
					$total = $sum[0][0]['sumAfterTax'];	

					$monthArray[$i] = array('value'=>$total);				
				}
				return $monthArray;
				break;	
			default:
				
				break;
		}
	}

	public function getCategory_values($type, $start, $end, $company_id, $category)
	{
		switch ($type) {
			case 'byDates':
				$daysApart = ceil(($end-$start)/86400);
				
				$categoryArray = array();
				for ($i=0; $i < $daysApart; $i++) {
					$plusDay = $start+($i*86400);
					$startDate = date('Y-m-d',$plusDay).' 00:00:00';
					$endDate = date('Y-m-d',$plusDay).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems AS Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category`="'.$category.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
					$total = $sum[0][0]['sumAfterTax'];
					if ($total == '') {
						$total = '0.00';
					}
					$categoryArray[$i]= array('value'=>$total);
										
				}
				return $categoryArray;
				break;
			case 'thisWeek':

				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
								     AND `Invoice_lineitem`.`category` = "'.$category.'"
								     AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sumWeek= $sum[0][0]['sumAfterTax'];
				return $sumWeek;				
				break;
			case 'lastWeek':

				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
								     AND `Invoice_lineitem`.`category` = "'.$category.'"
								     AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sumWeek= $sum[0][0]['sumAfterTax'];
				return $sumWeek;				
				break;			
			case 'weekAvg':
				$startDate = $this->query('SELECT `Invoice_lineitem`.`created` FROM invoice_lineitems AS Invoice_lineitem
										   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										   ORDER BY `Invoice_lineitem`.`id` ASC
										   LIMIT 0,1');
				foreach ($startDate as $row) {
					$begin = $row['Invoice_lineitem']['created'];
				}
				$startWeek = date('W',strtotime($begin));
				$endDate =date('Y-m-d',strtotime((date('Y-m-d')).'00:00:00')+(strtotime('this sunday',date('W')))).' 23:59:59';
				$endWeek = date('W')+1;
				$week = $endWeek-$startWeek;
				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
									 AND `Invoice_lineitem`.`category`="'.$category.'"
									 AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
							
				$sumWeek= ($sum[0][0]['sumAfterTax']/$week);	
				return $sumWeek;			
				break;
			case 'thisMonth':

				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
								     AND `Invoice_lineitem`.`category` = "'.$category.'"
								     AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sumMonth= $sum[0][0]['sumAfterTax'];
				return $sumMonth;				
				break;
			case 'monthAvg':
				$startYear = date('Y-').'01-01 00:00:00';
				$startDate = $this->query('SELECT `Invoice_lineitem`.`created` FROM invoice_lineitems AS Invoice_lineitem
										   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										   AND `Invoice_lineitem`.`created` >= "'.$startYear.'"
										   ORDER BY `Invoice_lineitem`.`id` ASC
										   LIMIT 0,1');
				foreach ($startDate as $row) {
					$begin = $row['Invoice_lineitem']['created'];
				}
				$end = date('Y-m-t').' 23:59:59';
				$startMonth = date('m',strtotime($begin));
				$endMonth = date('m')+1;
				$months = $endMonth-$startMonth;
				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
									 AND `Invoice_lineitem`.`category`="'.$category.'"
									 AND `Invoice_lineitem`.`created` BETWEEN "'.$begin.'" AND "'.$end.'"');
							
				$sumMonth= ($sum[0][0]['sumAfterTax']/$months);	
				return $sumMonth;			
				break;
			case 'selectedMonth':

				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
								     AND `Invoice_lineitem`.`category` = "'.$category.'"
								     AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sumMonth= $sum[0][0]['sumAfterTax'];
				return $sumMonth;				
				break;
			case 'selectedMonthAvg':
				$year =$start;
				//find all the sales of the year
				$startMonth = $year.'-01-01 00:00:00';
				$endMonth = $year.'-12-31 23:59:59';
				//get total months in business
				$beginMonth = $this->query('SELECT `Invoice_lineitem`.`created` FROM invoice_lineitems AS Invoice_lineitem
										   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										   AND `Invoice_lineitem`.`created` >= "'.$startMonth.'"
										   ORDER BY `Invoice_lineitem`.`id` ASC
										   LIMIT 0,1');
				foreach ($beginMonth as $row) {
					$begin = $row['Invoice_lineitem']['created'];
				}
				$month_start = date('m',strtotime($begin));
				$finishMonth = $this->query('SELECT `Invoice_lineitem`.`created` FROM invoice_lineitems AS Invoice_lineitem
										   WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										   AND `Invoice_lineitem`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"
										   ORDER BY `Invoice_lineitem`.`id` DESC
										   LIMIT 0,1');
				if(count($finishMonth) > 0){
					foreach ($finishMonth as $row) {
						$finish = $row['Invoice_lineitem']['created'];
					}
				} else {
					$finish = date('Y-m-d H:i:s','0');
				}
				$month_end = date('m',strtotime($finish))+1;
				$months = $month_end-$month_start;
				
				//get the sum of the months and divide by total months in business for the year
				$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) as sumAfterTax FROM invoice_lineitems AS Invoice_lineitem
									 WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
									 AND `Invoice_lineitem`.`category`="'.$category.'"
									 AND `Invoice_lineitem`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');
									 
				$avgMonthTotal = $sum[0][0]['sumAfterTax']/$months;
				return $avgMonthTotal;			
				break;
			case 'selectYearByMonth':
				$year = $start;
				$monthArray = array();
				for ($i=1; $i < 13; $i++) { 
					$startMonth = $year.'-'.$i.'-01 00:00:00';	
					$endMonth = $year.'-'.$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice_lineitem`.`after_tax`) AS sumAfterTax FROM invoice_lineitems as Invoice_lineitem
										 WHERE `Invoice_lineitem`.`company_id` = '.$company_id.'
										 AND `Invoice_lineitem`.`category` = "'.$category.'"
										 AND `Invoice_lineitem`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');
					$total = $sum[0][0]['sumAfterTax'];	

					$monthArray[$i] = array('value'=>$total);				
				}
				return $monthArray;
				break;	
			default:
				
				break;
		}	
	}

/**
 * Gather all the necessary data needed for the reports (all reports)
 * 
 * @return array
 */
	public function ordersReport($type,$company_id, $date, $category, $param5)
	{
		switch ($type) {
			case 'today':
				//set up variables
				$start = date('Y-m-d').' 00:00:00';
				$end = date('Y-m-d').' 23:59:59';
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_today':
				//set up variables
				$start = date('Y-m-d').' 00:00:00';
				$end = date('Y-m-d').' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_today':
				//set up variables
				$start = date('Y-m-d').' 00:00:00';
				$end = date('Y-m-d').' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'yesterday':
				//set up variables
				$start = date('Y-m-d',$date).' 00:00:00';
				$end = date('Y-m-d',$date).' 23:59:59';
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_yesterday':
				//set up variables
				$start = date('Y-m-d',$date).' 00:00:00';
				$end = date('Y-m-d',$date).' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_yesterday':
				//set up variables
				$start = date('Y-m-d',$date).' 00:00:00';
				$end = date('Y-m-d',$date).' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'byDates':
				//set up variables
				$start = date('Y-m-d',$date['start']).' 00:00:00';
				$end = date('Y-m-d',$date['end']).' 23:59:59';
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_byDates':
				//set up variables
				$start = date('Y-m-d',$date['start']).' 00:00:00';
				$end = date('Y-m-d',$date['end']).' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_byDates':
				//set up variables
				$start = date('Y-m-d',$date['start']).' 00:00:00';
				$end = date('Y-m-d',$date['end']).' 23:59:59';
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'thisWeek':
				//set up variables
				$day = date('l');
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));				
						break;
					default:
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));		
						break;
				}
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_thisWeek':
				//set up variables
				$day = date('l');
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));				
						break;
					default:
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));		
						break;
				}
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_thisWeek':
				//set up variables
				$day = date('l');
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));				
						break;
					default:
						$start = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));		
						break;
				}
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'lastWeek':
				//set up variables
				$minusWeek = 7*86400;
				$day = date('l',strtotime(date('Y-m-d H:i:s'))-$minusWeek);
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',(strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));			
						break;
					default:
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
				}
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_lastWeek':
				//set up variables
				$minusWeek = 7*86400;
				$day = date('l',strtotime(date('Y-m-d H:i:s'))-$minusWeek);
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',(strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));			
						break;
					default:
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
				}
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_lastWeek':
				//set up variables
				$minusWeek = 7*86400;
				$day = date('l',strtotime(date('Y-m-d H:i:s'))-$minusWeek);
				switch ($day) {
					case 'Monday':
						$start = date('Y-m-d H:i:s',(strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
					case 'Sunday':
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));			
						break;
					default:
						$start = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
						$end = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
				}
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'selectedWeek':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_selectedWeek':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_selectedWeek':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			case 'month_year':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				//first get the sum qty and base price of all the orders
				$countOrders = count($param5);
				$countCategory = count($category);
				$order_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$order_sum[$category_name] = array();
					$b= 0;
					for ($i=0; $i < $countOrders; $i++) {
						$order_id = $param5[$i]['Order']['id'];
						$order_name = $param5[$i]['Order']['name'];
						$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
												WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
												AND `Invoice_lineitem`.`order_id`='.$order_id.'
												AND `Invoice_lineitem`.`category`= "'.$category_name.'"
												AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
						$quantity = $sum_qty[0][0]['sumQuantity'];
						$before_tax = number_format($param5[$i]['Order']['price'],2);
						$total = number_format($before_tax*$quantity,2);
						if ($quantity != '') {
							$b = $b+1;
							$order_sum[$category_name][$b] =array('name'=>$order_name,'quantity'=>$quantity,'total'=>$total);	
						}
					}					
				}

				return $order_sum;
				break;
			case 'categoryTotals_month_year':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				$category_sum = array();
				for ($a=0; $a < $countCategory; $a++) {
					$category_name = $category[$a]['Category']['name']; 
					$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$quantity = $sum_qty[0][0]['sumQuantity'];
					$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
											WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
											AND `Invoice_lineitem`.`category`= "'.$category_name.'"
											AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
					$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
					$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
					$sumTax = number_format($afterTax-$beforeTax,2);
					$category_sum[$a] = array('quantity'=>$quantity,'before_tax'=>$beforeTax,'after_tax'=>$afterTax,'tax'=>$sumTax);
				}

				return $category_sum;				
				break;
			case 'summaryReport_month_year':
				//create variables
				$start = $date['start'];
				$end = $date['end'];
				$tax = $param5;
				//first get the sum qty and base price of all the orders
				$countCategory = count($category);
				
				$sum_qty= $this->query('SELECT sum(`Invoice_lineitem`.`quantity`) as sumQuantity FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$quantity = $sum_qty[0][0]['sumQuantity'];
				$sum_price= $this->query('SELECT sum(`Invoice_lineitem`.`before_tax`) as sumBeforeTax FROM invoice_lineitems AS Invoice_lineitem
										WHERE `Invoice_lineitem`.`company_id`='.$company_id.'
										AND `Invoice_lineitem`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$beforeTax = number_format($sum_price[0][0]['sumBeforeTax'],2);
				$afterTax = number_format(round($beforeTax*(1+$tax),2),2);
				$sumTax = number_format($afterTax-$beforeTax,2);
				$category_sum = array('before_tax'=>$beforeTax,'quantity'=>$quantity,'after_tax'=>$afterTax,'tax'=>$sumTax);

				return $category_sum;				
				break;
			default:
				
				break;
		}
	}
}
