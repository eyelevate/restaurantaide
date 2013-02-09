<?php
App::uses('AppModel', 'Model');
/**
 * Invoice Model
 *
 */
class Invoice extends AppModel {
	public $name = 'Invoice';

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
		'payment_number' => array(
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
 * next invoice method
 * 
 * @return variable
 */
	public function nextInvoice($company_id)
	{
		$next_invoice =	$this->query('SELECT `Invoice`.`invoice_number` 
								  	  FROM `restaurantaide`.`invoices` AS `Invoice`
								      WHERE `Invoice`.`company_id` = '.$company_id.'
								      ORDER BY `Invoice`.`invoice_number` DESC
								      LIMIT 0,1');
		$count_next = count($next_invoice);
		if ($count_next >0) {
			foreach ($next_invoice as $row) {
				$next_invoice_id = $row['Invoice']['invoice_number'];
				$next_invoice_id = $next_invoice_id+1;
			}
		} else {
			$next_invoice_id = 1;
		}
		return $next_invoice_id;
	}

/**
 * sumAfterTax method
 * from ReportsController ->today
 * @return value
 */
	public function findSum($type, $company_id)
	{
		switch ($type) {
			case 'Today':
				$start = date('Y-m-d').' 00:00:00';
				$end = date('Y-m-d').' 23:59:59';
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sum_rows =count($sum);
				
				if ($sum_rows>0) {
					foreach ($sum as $row) {
						$todaySum = $row[0]['sumAfterTax'];
					}
				} 
				
				if($todaySum ==''){
					$todaySum = '0.00';
				} 
			
				return $todaySum;
				break;
				
			case 'Yesterday':
				$start = date('Y-m-d',(strtotime(date('Y-m-d H:i:s')))-86400).' 00:00:00';
				$end = date('Y-m-d',(strtotime(date('Y-m-d H:i:s')))-86400).' 23:59:59';
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				$sum_rows =count($sum);
				
				if ($sum_rows>0) {
					foreach ($sum as $row) {
						$yesterdaySum = $row[0]['sumAfterTax'];
					}
				} 
				
				if($yesterdaySum ==''){
					$yesterdaySum = '0.00';
				} 
			
				return $yesterdaySum;				
				break;
				
			case 'Daily':
				$start = $this->query('SELECT * FROM invoices AS Invoice
									   WHERE `Invoice`.`company_id`='.$company_id.'
									   ORDER BY `Invoice`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 ORDER BY `Invoice`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice']['created']);
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
					$findNoZero = $this->query('SELECT sum(`Invoice`.`after_tax`) AS findNoZero FROM invoices AS Invoice
											 	WHERE `Invoice`.`company_id` = '.$company_id.'
											 	AND `Invoice`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
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

				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'');
				$sum_rows =count($sum);
				
				if ($sum_rows>0) {
					foreach ($sum as $row) {
						$totalSum = $row[0]['sumAfterTax'];
					}
				} 
				if($totalSum >0){
					$dailyAvg = $totalSum/$countOfDays;
				} else {
					$dailyAvg = '0.00';
				} 
			
				return number_format(round($dailyAvg,2),2);		
				break;	
			case 'DayAverage':
				$day = date('l');
	
				$start = $this->query('SELECT * FROM invoices AS Invoice
									   WHERE `Invoice`.`company_id`='.$company_id.'
									   AND `Invoice`.`day_paid` = "'.$day.'" 
									   ORDER BY `Invoice`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`day_paid` = "'.$day.'"
									 ORDER BY `Invoice`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice']['created']);
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
					$findNoZero = $this->query('SELECT sum(`Invoice`.`after_tax`) AS findNoZero FROM invoices AS Invoice
											 	WHERE `Invoice`.`company_id` = '.$company_id.'
											 	AND `Invoice`.`day_paid` = "'.$day.'"
											 	AND `Invoice`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
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

				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`day_paid` = "'.$day.'"');
				$sum_rows =count($sum);
				
				if ($sum_rows>0) {
					foreach ($sum as $row) {
						$totalSum = $row[0]['sumAfterTax'];
					}
				} 
				if($totalSum >0){
					$dayAvg = $totalSum/$countOfDays;
				} else {
					$dayAvg = '0.00';
				} 
				return number_format(round($dayAvg,2),2);	
				break;
			case 'YesterdayDayAverage':
				$day = date('l',(strtotime(date('Y-m-d H:i:s'))-86400));
	
				$start = $this->query('SELECT * FROM invoices AS Invoice
									   WHERE `Invoice`.`company_id`='.$company_id.'
									   AND `Invoice`.`day_paid` = "'.$day.'" 
									   ORDER BY `Invoice`.`id` ASC
									   LIMIT 0,1');
				$start_count = count($start);
				if ($start_count >0) {
					foreach ($start as $rowStart) {
						$startTime = strtotime($rowStart['Invoice']['created']);
						$startTime = date('Y-m-d',$startTime).' 00:00:00';
						$startTime = strtotime($startTime);
					}
				} else {
					$startTime = 0;
				}
				$end = $this->query('SELECT * FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`day_paid` = "'.$day.'"
									 ORDER BY `Invoice`.`id` DESC
									 LIMIT 0,1');
				$end_count = count($end);
				if ($end_count >0) {
					foreach ($end as $rowEnd) {
						$endTime = strtotime($rowEnd['Invoice']['created']);
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
					$findNoZero = $this->query('SELECT sum(`Invoice`.`after_tax`) AS findNoZero FROM invoices AS Invoice
											 	WHERE `Invoice`.`company_id` = '.$company_id.'
											 	AND `Invoice`.`day_paid` = "'.$day.'"
											 	AND `Invoice`.`created` BETWEEN "'.$begin.'" AND "'.$finish.'"');
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

				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`day_paid` = "'.$day.'"');
				$sum_rows =count($sum);
				
				if ($sum_rows>0) {
					foreach ($sum as $row) {
						$totalSum = $row[0]['sumAfterTax'];
					}
				} 
				if($totalSum >0){
					$dayAvg = $totalSum/$countOfDays;
				} else {
					$dayAvg = '0.00';
				} 
				return number_format(round($dayAvg,2),2);	
				break;
			case 'thisWeek':
				$day = date('l');
				switch ($day) {
					case 'Monday':
						$lastMonday = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
						break;
					case 'Sunday':
						$lastMonday = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$thisSunday = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));				
						break;
					default:
						$lastMonday = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))));
						$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));		
						break;
				}
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$lastMonday.'" AND "'.$thisSunday.'"');	
				return $sum[0][0]['sumAfterTax'];					
				break;
			case 'lastWeek':
				$minusWeek = 7*86400;
				$day = date('l', strtotime(date('Y-m-d H:i:s'))-$minusWeek);
				switch ($day) {
					case 'Monday':
						$lastMonday = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						break;
					case 'Sunday':
						$lastMonday = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						$thisSunday = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));				
						break;
					default:
						$lastMonday = date('Y-m-d H:i:s',strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
						$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));		
						break;
				}
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$lastMonday.'" AND "'.$thisSunday.'"');	
				return $sum[0][0]['sumAfterTax'];					
				break;				
			
			case 'avgWeek':
				$startDate = $this->query('SELECT `Invoice`.`created` FROM invoices AS Invoice
										   WHERE `Invoice`.`company_id`='.$company_id.'
										   ORDER BY `Invoice`.`id` ASC
										   LIMIT 0,1');
				foreach ($startDate as $row) {
					$begin = $row['Invoice']['created'];
				}
				$startWeek = date('W',strtotime($begin));
				$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
				$endWeek = date('W')+1;
				$week = $endWeek-$startWeek;
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$begin.'" AND "'.$thisSunday.'"');
							
				$sumWeek= ($sum[0][0]['sumAfterTax']/$week);	
				return $sumWeek;
				break;
			case 'thisMonth':
				$startMonth = date('Y-m').'-01 00:00:00';
				$endMonth = date('Y-m-t').' 23:59:59';
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');	
				return $sum[0][0]['sumAfterTax'];					
				break;	
			case 'lastMonth':
				$startMonth = strtotime(date('Y-m-').'01 00:00:00')-86400;
				$startMonth = date('Y-m',$startMonth).'-01 00:00:00';
				$endMonth = strtotime(date('Y-m-').'01 00:00:00')-86400;
				$endMonth = date('Y-m-t',$endMonth).' 23:59:59';
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');	
				return $sum[0][0]['sumAfterTax'];					
				break;			
			case 'avgMonth':
				$startYear = date('Y-').'01-01 00:00:00';
				$startMonth = $this->query('SELECT `Invoice`.`created` FROM invoices AS Invoice
										   WHERE `Invoice`.`company_id`='.$company_id.'
										   AND `Invoice`.`created` >= "'.$startYear.'"
										   ORDER BY `Invoice`.`id` ASC
										   LIMIT 0,1');
				foreach ($startMonth as $row) {
					$begin = $row['Invoice']['created'];
				}
				$end = date('Y-m-t').' 23:59:59';
				$startMonth = date('m',strtotime($begin));
				$endMonth = date('m')+1;
				$months = $endMonth-$startMonth;
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id` = '.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$begin.'" AND "'.$end.'"');
							
				$sumMonth= ($sum[0][0]['sumAfterTax']/$months);	
				return $sumMonth;
				break;			
			case 'yearByDays':
				$startYear = date('Y-').'01-01 00:00:00';
				$endYear = date('Y-m-d H:i:s');
				$daysTotal = ceil((strtotime($endYear)-strtotime($startYear))/86400);
				$sumArray = array();
				$b = 0;
				for ($i=0; $i < $daysTotal+1; $i++) {
					$plusDay = $i*86400; 
					$startDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 00:00:00';
					$endDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startDay.'" AND "'.$endDay.'"');	
					$sumDay = $sum[0][0]['sumAfterTax'];
					if ($sumDay != 0) {
						//add to the array base set and create values
						$b = $b+1;
						$date = strtotime($startDay);
						$sumArray[$b] = array('date'=>$date,'sum'=>$sumDay);
					} else {
						//do nothing
						$b = $b;
					}
				}
				return $sumArray;
				break;
			case 'yearByWeeks':
				$startYear = date('Y-').'01-01 00:00:00';
				$endYear = date('Y-m-d H:i:s');

				$sumArray = array();
				$b = 0;
				for ($i=0; $i <= 52; $i++) {
					$plusWeek = $i*(7*86400); 
					$day = date('l',strtotime($startYear)+$plusWeek);
					switch ($day) {
						case 'Monday':
							$startWeek = date('Y-m-d',strtotime('monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';
							break;
						case 'Sunday':
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';			
							break;
						default:
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';		
							break;
					}

					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startWeek.'" AND "'.$endWeek.'"');	
					$sumWeek = $sum[0][0]['sumAfterTax'];
					//add to the array base set and create values
					$date = strtotime($startWeek);
					$sumArray[$i] = array('date'=>$date,'sum'=>$sumWeek);
	
				}
				return $sumArray;	
				break;
			case 'yearByMonth':
				$sumArray = array();
				for ($i=1; $i < 13; $i++) {

					$startMonth = date('Y-').$i.'-01 00:00:00';
					$endMonth = date('Y-').$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');	
					$sumMonth = $sum[0][0]['sumAfterTax'];

					//add to the array base set and create values
					$date = strtotime($startMonth);
					$sumArray[$i] = array('value'=>$sumMonth);
	
				}
				return $sumArray;			
				break;
			case 'lastYearByDays':
				$year = (date('Y')-1);
				$startYear = $year.'-01-01 00:00:00';
				$endYear = $year.'-12-31 23:59:59';
				$daysTotal = ceil((strtotime($endYear)-strtotime($startYear))/86400);
				$sumArray = array();
				$b = 0;
				for ($i=0; $i < $daysTotal+1; $i++) {
					$plusDay = $i*86400; 
					$startDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 00:00:00';
					$endDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startDay.'" AND "'.$endDay.'"');	
					$sumDay = $sum[0][0]['sumAfterTax'];
					if ($sumDay != 0) {
						//add to the array base set and create values
						$b = $b+1;
						$date = strtotime($startDay);
						$sumArray[$b] = array('date'=>$date,'sum'=>$sumDay);
					} else {
						//do nothing
						$b = $b;
					}
				}
				return $sumArray;
				break;
			case 'lastYearByWeeks':
				$year = (date('Y')-1);
				$startYear = $year.'-01-01 00:00:00';
				$endYear = $year.'-12-31 23:59:59';
				$week_count = date('W',strtotime($endYear));
				$sumArray = array();
				$b = 0;
				for ($i=0; $i < $endYear; $i++) {
					$plusWeek = $i*(7*86400); 
					$day = date('l',strtotime($startYear)+$plusWeek);
					switch ($day) {
						case 'Monday':
							$startWeek = date('Y-m-d',strtotime('monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';
							break;
						case 'Sunday':
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';			
							break;
						default:
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';		
							break;
					}
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startWeek.'" AND "'.$endWeek.'"');	
					$sumWeek = $sum[0][0]['sumAfterTax'];
					//add to the array base set and create values
					$date = strtotime($startWeek);
					$sumArray[$i] = array('date'=>$date,'sum'=>$sumWeek);
	
				}
				return $sumArray;	
				break;
			case 'lastYearByMonth':
				$year =(date('Y')-1);
				$sumArray = array();
				for ($i=1; $i < 13; $i++) {

					$startMonth = $year.'-'.$i.'-01 00:00:00';
					$endMonth = $year.'-'.$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');	
					$sumMonth = $sum[0][0]['sumAfterTax'];

					//add to the array base set and create values
					$sumArray[$i] = array('value'=>$sumMonth);
	
				}
				return $sumArray;			
				break;
		}
	}

	public function findSum_selection($type,$date,$company_id)
	{
		switch ($type) {
			case 'byDates':
				$startDate = $date.' 00:00:00';
				$endDate = $date.' 23:59:59';
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
				$total =$sum[0][0]['sumAfterTax'];
				if ($total =='') {
					return FALSE;
				} else {
					return $total;	
				}
				
				break;
			case 'selectYearByDays':
				$year = $date;
				$startYear = $year.'-01-01 00:00:00';
				$endYear = $year.'-12-31 23:59:59';
				$daysTotal = ceil((strtotime($endYear)-strtotime($startYear))/86400);
				$sumArray = array();
				$b = 0;
				for ($i=0; $i < $daysTotal; $i++) {
					$plusDay = $i*86400; 
					$startDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 00:00:00';
					$endDay = date('Y-m-d',strtotime($startYear)+$plusDay).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startDay.'" AND "'.$endDay.'"');	
					$sumDay = $sum[0][0]['sumAfterTax'];
					if ($sumDay != 0) {
						//add to the array base set and create values
						$b = $b+1;
						$date = strtotime($startDay);
						$sumArray[$b] = array('date'=>$date,'sum'=>$sumDay);
					} else {
						//do nothing
						$b = $b;
					}
				}
				return $sumArray;
				break;
			case 'selectYearByWeeks':			
				$year = $date;
				$startYear = $year.'-01-01 00:00:00';
				$endYear = $year.'-12-31 23:59:59';
				
				$sumArray = array();
				for ($i=0; $i <= 52; $i++) {
					$plusWeek = $i*(7*86400); 
					$day = date('l',strtotime($startYear)+$plusWeek);
					switch ($day) {
						case 'Monday':
							$startWeek = date('Y-m-d',strtotime('monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';
							break;
						case 'Sunday':
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';			
							break;
						default:
							$startWeek = date('Y-m-d',strtotime('last monday, 12am',strtotime($startYear)+$plusWeek)).' 00:00:00';
							$endWeek = date('Y-m-d',strtotime('next sunday 12am',strtotime($startYear)+$plusWeek)).' 23:59:59';		
							break;
					}		
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startWeek.'" AND "'.$endWeek.'"');	
					$sumWeek = $sum[0][0]['sumAfterTax'];
					//add to the array base set and create values
					$date = strtotime($startWeek);
					$sumArray[$i] = array('date'=>$date,'sum'=>$sumWeek);
	
				}
				return $sumArray;	
				break;
			case 'selectYearByMonths':
				$year =$date;
				$sumArray = array();
				for ($i=1; $i < 13; $i++) {

					$startMonth = $year.'-'.$i.'-01 00:00:00';
					$endMonth = $year.'-'.$i.date('-t',strtotime($startMonth)).' 23:59:59';
					$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) AS sumAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id` = '.$company_id.'
										 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');	
					$sumMonth = $sum[0][0]['sumAfterTax'];

					//add to the array base set and create values
					$sumArray[$i] = array('value'=>$sumMonth);
	
				}
				return $sumArray;			
				break;			
			default:
				
				break;
		}
	}
	public function findSum_choose($type, $start, $end, $company_id)
	{
		switch ($type) {
			case 'chooseWeek':	
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				return $sum[0][0]['sumAfterTax'];
				break;
			case 'chooseMonth':
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$start.'" AND "'.$end.'"');
				return $sum[0][0]['sumAfterTax'];				
				break;
			case 'avgSelectedMonth':
				$year =$start;
				//find all the sales of the year
				$startMonth = $year.'-01-01 00:00:00';
				$endMonth = $year.'-12-31 23:59:59';
				//get total months in business
				$beginMonth = $this->query('SELECT `Invoice`.`created` FROM invoices AS Invoice
										   WHERE `Invoice`.`company_id`='.$company_id.'
										   AND `Invoice`.`created` >= "'.$startMonth.'"
										   ORDER BY `Invoice`.`id` ASC
										   LIMIT 0,1');
				foreach ($beginMonth as $row) {
					$begin = $row['Invoice']['created'];
				}
				$month_start = date('m',strtotime($begin));
				$finishMonth = $this->query('SELECT `Invoice`.`created` FROM invoices AS Invoice
										   WHERE `Invoice`.`company_id`='.$company_id.'
										   AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"
										   ORDER BY `Invoice`.`id` DESC
										   LIMIT 0,1');
				foreach ($finishMonth as $row) {
					$finish = $row['Invoice']['created'];
				}
				$month_end = date('m',strtotime($finish))+1;
				$months = $month_end-$month_start;
				
				//get the sum of the months and divide by total months in business for the year
				$sum = $this->query('SELECT sum(`Invoice`.`after_tax`) as sumAfterTax FROM invoices AS Invoice
									 WHERE `Invoice`.`company_id`='.$company_id.'
									 AND `Invoice`.`created` BETWEEN "'.$startMonth.'" AND "'.$endMonth.'"');
									 
				$avgMonthTotal = $sum[0][0]['sumAfterTax']/$months;
				return $avgMonthTotal;					 					
				break;
			default:
				
				break;
		}		
	}
}
