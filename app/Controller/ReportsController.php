<?php

/**
 * app/Controller/ReportsController.php
 */
class ReportsController extends AppController {
    //Name (should be same as the class name)
    public $name = 'Reports';
	public $uses = array('Menu','Menu_item','User','Group','Category','Order','Company','TaxInfo','Invoice','InvoiceLineitem','Report');	
	//fusion chart load
	public $components = array('FusionCharts.FusionCharts');
	public $helpers = array('FusionCharts.FusionCharts');

	public $FusionCharts = null;


	public function beforeFilter()
	{
		parent::beforeFilter();
		//set the default layout
		$this->layout = 'reports';
		$this->set('username',AuthComponent::user('username'));
		$this->set('company_id',$this->Session->read('Company.company_id'));			
		//set the navigation menu_id		
		$group_id = AuthComponent::user('group_id');
		$user_group = $this->Group->find('all',array('conditions'=>array('id'=>$group_id)));
		if(!empty($user_group)){
		foreach ($user_group as $ug) {
			$group_name = $ug['Group']['name'];
		}		
		} else {
			$group_name = '';
		}
		$menu_ids = $this->Menu->find('all',array('conditions'=>array('name'=>$group_name)));
		if(!empty($menu_ids)){
			$menu_id = $menu_ids[0]['Menu']['id'];	
		} else {
			$menu_id = '0';
		}	
		$this->Session->write('Admin.menu_id',$menu_id);	
		//set the authorized pages
		$this->Auth->deny('*');
		$this->Auth->authError = 'You do not have access to this page. Please Login';
		
	}
/**
 * reports method
 * @return void
 */
	public function index()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/index';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		
		//set variables
		$today = $this->Report->reportDates('today');
		$yesterday = $this->Report->reportDates('yesterday');
		$thisWeek = $this->Report->reportDates('thisWeek');
		$thisMonth = $this->Report->reportDates('thisMonth');
		$thisYear = $this->Report->reportDates('thisYear');
		$lastWeek = $this->Report->reportDates('lastWeek');
		$lastMonth = $this->Report->reportDates('lastMonth');
		$lastYear = $this->Report->reportDates('lastYear');

		//set dates to view for reports
		$this->set('today',$today);	
		$this->set('yesterday',$yesterday);
		$this->set('thisWeek',$thisWeek);
		$this->set('thisMonth',$thisMonth);
		$this->set('thisYear',$thisYear);
		$this->set('lastWeek',$lastWeek);
		$this->set('lastMonth',$lastMonth);
		$this->set('lastYear',$lastYear);	
	}

	
	public function today()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/today';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		//set variables 
		$company_id = $this->Session->read('Company.company_id');
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$today = date('n/d/Y');
		$day = date('l');
		$maxAmount = '2000';
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$todaySum = $this->Invoice->findSum('Today',$company_id);

		$dailySum = $this->Invoice->findSum('Daily',$company_id);
		$dayAvg = $this->Invoice->findSum('DayAverage',$company_id);
		$colorsArray = array('AFD8F8','F6BD0F','8BBA00','FF0000','607b20','69207b','00fcff','a2ff00','4d5e31','a9d7b7','000d8c');
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('today',$company_id, $today, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_today',$company_id, $today, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_today', $company_id, $today, null, $tax_rate);

		$salesData1 = $this->InvoiceLineitem->salesData('Today',$category,$company_id);
		$salesData2 = $this->InvoiceLineitem->salesData('Daily',$category,$company_id);
		$salesData3 = $this->InvoiceLineitem->salesData('DayAvg',$category, $company_id);

		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);
		//create chart
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);
		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'					=> 'Todays Sales (After Tax Values)',
				'subCaption'				=> $today,
				'xAxisName'					=> 'Type',
				'yAxisName'					=> 'Sales',
				'yAxisMaxValue'				=> $maxAmount,
				'hoverCapBg'				=> 'DEDEBE',
				'hoverCapBorder'			=> '889E6D',
				'decimalPrecision'			=> '2',
				'rotateNames'				=> '0',
				'numDivLines'				=> '9',
				'numberPrefix'				=> '$',
				'showValues'				=> '1',
				'divLineColor'				=> 'CCCCCC',
				'divLineAlpha'				=> '80',
				'decimalPrecision'			=> '2',
				'showAlternateHGridColor'	=> '1',
				'AlternateHGridAlpha'		=> '30',
				'AlternateHGridColor'		=> 'CCCCCC',
				'formatNumberScale'			=> '0'
			)
		);	


		$this->FusionCharts->setCategoriesParams(
			'Column3D Chart',
			array(
				'font' => 'Arial',
				'fontSize' => '11',
				'fontColor' => '000000'
			)
		);

		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				'Today ($'.$todaySum.')',
				'Daily Avg. ($'.$dailySum.')',
				$day.' Avg. ($'.$dayAvg.')'
			)
		);

		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $salesData1[$i]['name'];
			$category_price1[$i] = sprintf('%.2f',$salesData1[$i]['total']);
			$category_price2[$i] = sprintf('%.2f',$salesData2[$i]['total']);
			$category_price3[$i] = sprintf('%.2f',$salesData3[$i]['total']);

			$color[$i] = $colorsArray[$i];
			$this->FusionCharts->addDatasets(
					'Column3D Chart',
					array($category_name[$i] => array(
						'params' => array(
							'color' => $color[$i],
							'showValues' => '1'
						),
						'data' => array(
							array('value' => $category_price1[$i]),
							array('value' => $category_price2[$i]),
							array('value' => $category_price3[$i])
						)
					)
				)
			);	
		}
	}
	
	public function yesterday()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/yesterday';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		//set variables 
		$company_id = $this->Session->read('Company.company_id');
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$yesterdayTime = strtotime(date('Y-m-d H:i:s'))-86400;
		$yesterday = date('n/d/Y',$yesterdayTime);
		$day = date('l',$yesterdayTime);
		$yesterdaySum = $this->Invoice->findSum('Yesterday',$company_id);
		$dailySum = $this->Invoice->findSum('Daily',$company_id);
		$yesterdayDayAvg = $this->Invoice->findSum('YesterdayDayAverage',$company_id);
		$colorsArray = array('AFD8F8','F6BD0F','8BBA00','FF0000','607b20','69207b','00fcff','a2ff00','4d5e31','a9d7b7','000d8c');
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('yesterday',$company_id, $yesterdayTime, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_yesterday',$company_id, $yesterdayTime, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_yesterday', $company_id, $yesterdayTime, null, $tax_rate);		
		$salesData1 = $this->InvoiceLineitem->salesData('Yesterday',$category,$company_id);
		$salesData2 = $this->InvoiceLineitem->salesData('Daily',$category,$company_id);
		$salesData3 = $this->InvoiceLineitem->salesData('YesterdayDayAvg',$category, $company_id);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);		
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'					=> 'Yesterday\'s Sales (After Tax Values)',
				'subCaption'				=> $yesterday,
				'xAxisName'					=> 'Type',
				'yAxisName'					=> 'Sales',
				'hoverCapBg'				=> 'DEDEBE',
				'hoverCapBorder'			=> '889E6D',
				'decimalPrecision'			=> '2',
				'rotateNames'				=> '0',
				'numDivLines'				=> '9',
				'numberPrefix'				=> '$',
				'showValues'				=> '1',
				'divLineColor'				=> 'CCCCCC',
				'divLineAlpha'				=> '80',
				'decimalPrecision'			=> '2',
				'showAlternateHGridColor'	=> '1',
				'AlternateHGridAlpha'		=> '30',
				'AlternateHGridColor'		=> 'CCCCCC',
				'formatNumberScale'			=> '0'
			)
		);	

		$this->FusionCharts->setCategoriesParams(
			'Column3D Chart',
			array(
				'font' => 'Arial',
				'fontSize' => '11',
				'fontColor' => '000000'
			)
		);

		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				'Yesterday ($'.$yesterdaySum.')',
				'Daily Avg. ($'.$dailySum.')',
				$day.' Avg. ($'.$yesterdayDayAvg.')'
			)
		);

		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $salesData1[$i]['name'];
			$category_price1[$i] = number_format($salesData1[$i]['total'],2);
			$category_price2[$i] = number_format($salesData2[$i]['total'],2);
			$category_price3[$i] = number_format($salesData3[$i]['total'],2);
			$color[$i] = $colorsArray[$i];
			$this->FusionCharts->addDatasets(
					'Column3D Chart',
					array($category_name[$i] => array(
						'params' => array(
							'color' => $color[$i],
							'showValues' => '1'
						),
						'data' => array(
							array('value' => $category_price1[$i]),
							array('value' => $category_price2[$i]),
							array('value' => $category_price3[$i])
						)
					)
				)
			);	
		}	
	}
	
	public function byDates()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/by_dates';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		if ($this->request->is('post')) {
			$startDate = strtotime($this->request->data['byDates']['Start Date'].' 00:00:00');
			$endDate = strtotime($this->request->data['byDates']['End Date'].' 23:59:59');
			$date_range = array('start'=>$startDate,'end'=>$endDate);
			if($startDate == ''){
				$this->Session->setFlash('You must have a start date');
			} elseif($endDate =='' ) {
				$this->Session->setFlash('You must have an end date');
			} elseif($endDate < $startDate) {
				$this->Session->setFlash('End date must be set after start date');
			} else{
				//set the values and show the chart
				$this->set('startDate',$startDate);
				$this->set('endDate',$endDate);
				$daysApart = ceil(($endDate-$startDate)/86400);
				$company_id = $this->Session->read('Company.company_id');
				$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
				$category_count = count($category);
				$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
				$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
				$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
				$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
				$orders_report = $this->InvoiceLineitem->ordersReport('byDates',$company_id, $date_range, $category, $orders);
				$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_byDates',$company_id, $date_range, $category, $tax_rate);
				$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_byDates', $company_id, $date_range, null, $tax_rate);
				//send to view to create report
				$this->set('category',$category);
				$this->set('category_totals',$category_totals);
				$this->set('orders_report',$orders_report);
				$this->set('endOfDay', $endOfDayTotals);	
				$this->set('dateRange',$date_range);
				//find the daily sum of each day
				$dailySum = array();
				for ($i=0; $i < $daysApart; $i++) {
					$addDay = $i*86400;
					$date = date('Y-m-d',$startDate+$addDay);
					$salesTotal[$i] = $this->Invoice->findSum_selection('byDates',$date, $company_id);	
					$dailySum[$i] = array('value'=>$salesTotal[$i]);
				}
				//find the daily sum of each category by day
				$this->FusionCharts->create(
					'Column3DLineDY Chart',
					array(
						'type' => 'MSColumn3DLineDY',
						'width' => 1000,
						'height' => 600,
						'id' => ''
					)
				);
		
				$this->FusionCharts->setChartParams(
					'Column3DLineDY Chart',
					array(
						'caption'				=> 'Selected Dates Sales Report ('. date('n/d/y',$startDate).' - '.date('n/d/y',$endDate).')',
						'PYAxisName'			=> 'Category Totals',
						'SYAxisName'			=> 'End Of Day Totals',
						'numberPrefix'			=> '$',
						'rotateNames'			=> '1',
						'showvalues'			=> '1',
						'numDivLines'			=> '4',
						'formatNumberScale'		=> '0',
						'decimalPrecision'		=> '2',
						'anchorSides'			=> '10',
						'anchorRadius'			=> '3',
						'anchorBorderColor'		=> '009900'
					)
				);
				//create an array to seperate the days
				$dateArray = array();
				for ($i=0; $i < $daysApart; $i++) { 
					$addDay = $i*86400;
					$date = date('n/d/y',$startDate+$addDay);
					$dateArray[$i] = $date;
				}
				
				$this->FusionCharts->addCategories(
					'Column3DLineDY Chart',
					$dateArray
				);
		
				//add data sets to every day

				for ($i=0; $i < $category_count; $i++) { 
					$category_name = $category[$i]['Category']['name'];
					$category_values[$i] = $this->InvoiceLineitem->getCategory_values('byDates',$startDate, $endDate, $company_id, $category_name);
 					$this->FusionCharts->addDatasets(
						'Column3DLineDY Chart',
						array(
							$category_name=>array(
								'params'=>array('color'=>$colorArray[$i], 'showValues'=>'0'),
								'data'=>$category_values[$i]
							)
						
						)
					);
				}
				
				$this->FusionCharts->addDatasets(
					'Column3DLineDY Chart',
					array(
						'Total Sum' => array(
							'params' => array('color' => 'ff0000', 'showValues' => '1', 'parentYAxis' => 'S'),
							'data' => $dailySum
						)
					)
				);			
			}
						
		}	
		
	}
	
	public function thisWeek()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/this_week';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			


		
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$start = date('Y').'-01-01 00:00:00';
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
		$thisWeekTotal = '$'.number_format($this->Invoice->findSum('thisWeek',$company_id),2);
		$avgWeekTotal = '$'.number_format($this->Invoice->findSum('avgWeek',$company_id),2);
		$date_range = '('.date('n/d/y',strtotime($lastMonday)).' - '.date('n/d/y',strtotime($thisSunday)).')';
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
		//report variables
		$dates = array('start'=>$lastMonday,'end'=>$thisSunday);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('thisWeek',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_thisWeek',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_thisWeek', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		$this->set('dateRange',$dates);
		
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'			=> 'This Week Sales',
				'subCaption'		=> $date_range,
				'xAxisName'			=> 'Week Types',
				'yAxisName'			=> 'Sales (After Tax)',
				'decimalPrecision'	=> '2',
				'rotateNames'		=> '0',
				'numDivLines'		=> '3',
				'numberPrefix'		=> '$',
				'showValues'		=> '1',
				'formatNumberScale'	=> '0'
			)
		);
		
		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				'This Week ('.$thisWeekTotal.')',
				'Weekly Avg. ('.$avgWeekTotal.')'
			)
		);
		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $category[$i]['Category']['name'];
			$thisWeekSum[$i] = $this->InvoiceLineitem->getCategory_values('thisWeek',$lastMonday, $thisSunday,$company_id, $category_name[$i]); 
			$weekAvg[$i] = $this->InvoiceLineitem->getCategory_values('weekAvg',$start, $thisSunday, $company_id, $category_name[$i]);
			
			$this->FusionCharts->addDatasets(
				'Column3D Chart',
				array(
					$category_name[$i]=>array(
						'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
						'data'=>array(
							array('value'=>$thisWeekSum[$i]),
							array('value'=>$weekAvg[$i])
						)
					)
				)
			);
			
		}

		
	}
	
	public function lastWeek()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/last_week';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		//set the title for the page
		$this->set('title_for_layout',__('Last Week\'s Sales Report'));		
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$start = date('Y').'-01-01 00:00:00';
		$minusWeek = 7*86400;
		$day = date('l',strtotime(date('Y-m-d H:i:s'))-$minusWeek);
		switch ($day) {
			case 'Monday':
				$lastMonday = date('Y-m-d H:i:s',(strtotime('monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
				$lastSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
				$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
				break;
			case 'Sunday':
				$lastMonday = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
				$lastSunday = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));	
				$thisSunday = date('Y-m-d H:i:s',strtotime('sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));		
				break;
			default:
				$lastMonday = date('Y-m-d H:i:s',(strtotime('last monday, 12am ',strtotime(date('Y-m-d H:i:s')))-$minusWeek));
				$lastSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))-$minusWeek));
				$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
				break;
		}
		
		$lastWeekTotal = '$'.number_format($this->Invoice->findSum('lastWeek',$company_id),2);
		$avgWeekTotal = '$'.number_format($this->Invoice->findSum('avgWeek',$company_id),2);
		$date_range = '('.date('n/d/y',strtotime($lastMonday)).' - '.date('n/d/y',strtotime($lastSunday)).')';
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','009d9f','9f9600','acacac');
		$dates = array('start'=>$lastMonday,'end'=>$lastSunday);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('lastWeek',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_lastWeek',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_lastWeek', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		$this->set('dateRange',$dates);	
		
		//start chart creation	
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'			=> 'Last Week Sales',
				'subCaption'		=> $date_range,
				'xAxisName'			=> 'Week Types',
				'yAxisName'			=> 'Sales (After Tax)',
				'decimalPrecision'	=> '2',
				'rotateNames'		=> '0',
				'numDivLines'		=> '3',
				'numberPrefix'		=> '$',
				'showValues'		=> '1',
				'formatNumberScale'	=> '0'
			)
		);
		
		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				'Last Week ('.$lastWeekTotal.')',
				'Weekly Avg. ('.$avgWeekTotal.')'
			)
		);
		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $category[$i]['Category']['name'];
			$lastWeekSum[$i] = $this->InvoiceLineitem->getCategory_values('lastWeek',$lastMonday, $lastSunday,$company_id, $category_name[$i]); 
			$weekAvg[$i] = $this->InvoiceLineitem->getCategory_values('weekAvg',$start, $thisSunday, $company_id, $category_name[$i]);
			
			$this->FusionCharts->addDatasets(
				'Column3D Chart',
				array(
					$category_name[$i]=>array(
						'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
						'data'=>array(
							array('value'=>$lastWeekSum[$i]),
							array('value'=>$weekAvg[$i])
						)
					)
				)
			);
			
		}	
	}
	
	public function byWeeks()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/by_weeks';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);			

		//set the title for the page
		$this->set('title_for_layout',__('Selected Week Sales Report'));
		$starting = date('Y-m-d H:i:s',strtotime('monday, 12am ',strtotime(date('Y').'-01-01 00:00:00')));
		$ending = date('Y-m-d H:i:s',strtotime('next sunday, 12am ',strtotime(date('Y').'-01-01 00:00:00')));	
		$weekArray = array();
		for ($i=date('W')-1; $i >= 0; $i--) {
			$nextWeek = $i*(7*86400);
			$start[$i+1] = date('n/d/y',strtotime($starting)+$nextWeek);
			$end[$i+1] = date('n/d/y',strtotime($ending)+$nextWeek); 	
			$weekArray[$i+1] = '[Week '.($i+1).'] ('.$start[$i+1].' - '.$end[$i+1].')';
		}	
		$this->set('weekArray',$weekArray);	
		//if someone selects a week
		if ($this->request->is('post')) {
			$this->set('weekSet',$this->request->data['byWeeks']['Weeks']);
			//set variables
			$weekSelected = $this->request->data['byWeeks']['Weeks'];
			$company_id = $this->Session->read('Company.company_id');
			for ($i=0; $i < 52; $i++) {
				$nextWeek = $i*(7*86400);
				$start[$i+1] = date('Y-m-d',strtotime($starting)+$nextWeek).' 00:00:00';
				$end[$i+1] = date('Y-m-d',strtotime($ending)+$nextWeek).' 23:59:59'; 	
			}	
			$thisSunday = date('Y-m-d H:i:s',strtotime('next sunday, 11:59:59pm ',strtotime(date('Y-m-d H:i:s'))));
			$weekStart = $start[$weekSelected];
			$weekEnd = $end[$weekSelected];
			$selectedTotal = '$'.number_format($this->Invoice->findSum_choose('chooseWeek',$weekStart, $weekEnd, $company_id),2);
			$avgWeekTotal = '$'.number_format($this->Invoice->findSum('avgWeek',$company_id),2);
			$date_range = '('.date('n/d/y',strtotime($weekStart)).' - '.date('n/d/y',strtotime($weekEnd)).')';
			$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
			$category_count = count($category);
			$colorArray = array('f3a0ff','00ff89','edff89','ffa4a0','ae84cf','ae8469','009d9f','9f9600','acacac','69ae9f','a2abff');
			$dates = array('start'=>$start[$weekSelected],'end'=>$end[$weekSelected]);
			$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
			$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
			$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
			$orders_report = $this->InvoiceLineitem->ordersReport('selectedWeek',$company_id, $dates, $category, $orders);
			$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_selectedWeek',$company_id, $dates, $category, $tax_rate);
			$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_selectedWeek', $company_id, $dates, null, $tax_rate);
			//send to view to create report
			$this->set('category',$category);
			$this->set('category_totals',$category_totals);
			$this->set('orders_report',$orders_report);
			$this->set('endOfDay', $endOfDayTotals);	
			$this->set('dateRange',$dates);	
			
			$this->FusionCharts->create(
				'Column3D Chart',
				array(
					'type' => 'StackedColumn3D',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);
	
			$this->FusionCharts->setChartParams(
				'Column3D Chart',
				array(
					'caption'			=> 'Selected Week Sales',
					'subCaption'		=> $date_range,
					'xAxisName'			=> 'Week Types',
					'yAxisName'			=> 'Sales (After Tax)',
					'decimalPrecision'	=> '2',
					'rotateNames'		=> '0',
					'numDivLines'		=> '3',
					'numberPrefix'		=> '$',
					'showValues'		=> '1',
					'formatNumberScale'	=> '0'
				)
			);
			
			$this->FusionCharts->addCategories(
				'Column3D Chart',
				array(
					'Week Chosen ('.$selectedTotal.')',
					'Weekly Avg. ('.$avgWeekTotal.')'
				)
			);
			for ($i=0; $i < $category_count; $i++) { 
				$category_name[$i] = $category[$i]['Category']['name'];
				$lastWeekSum[$i] = $this->InvoiceLineitem->getCategory_values('lastWeek',$weekStart, $weekEnd,$company_id, $category_name[$i]); 
				$weekAvg[$i] = $this->InvoiceLineitem->getCategory_values('weekAvg',date('Y').'-01-01 00:00:00', $thisSunday, $company_id, $category_name[$i]);
				
				$this->FusionCharts->addDatasets(
					'Column3D Chart',
					array(
						$category_name[$i]=>array(
							'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
							'data'=>array(
								array('value'=>$lastWeekSum[$i]),
								array('value'=>$weekAvg[$i])
							)
						)
					)
				);
				
			}			
						
			
		}
	}

	
	public function thisMonth()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/this_month';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$startYear = date('Y').'-01-01 00:00:00';
		$startMonth = date('Y-m').'-01 00:00:00';
		$endMonth = date('Y-m-t').' 23:59:59';

		$thisMonthTotal = '$'.number_format($this->Invoice->findSum('thisMonth',$company_id),2);
		$avgMonthTotal = '$'.number_format($this->Invoice->findSum('avgMonth',$company_id),2);
		$date_range = '('.date('n/d/y',strtotime($startMonth)).' - '.date('n/d/y',strtotime($endMonth)).')';
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('ff8400','d88aff','9fff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
		$dates = array('start'=>$startMonth,'end'=>$endMonth);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_month_year', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		//$this->set('dateRange',$dates);	
		
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'			=> 'This Month Sales',
				'subCaption'		=> $date_range,
				'xAxisName'			=> 'Month Types',
				'yAxisName'			=> 'Sales (After Tax)',
				'decimalPrecision'	=> '2',
				'rotateNames'		=> '0',
				'numDivLines'		=> '3',
				'numberPrefix'		=> '$',
				'showValues'		=> '1',
				'formatNumberScale'	=> '0'
			)
		);
		
		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				date('F Y').' ('.$thisMonthTotal.')',
				'Month Avg. ('.$avgMonthTotal.')'
			)
		);
		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $category[$i]['Category']['name'];
			$thisMonthSum[$i] = $this->InvoiceLineitem->getCategory_values('thisMonth',$startMonth, $endMonth,$company_id, $category_name[$i]); 
			$monthAvg[$i] = $this->InvoiceLineitem->getCategory_values('monthAvg',$startYear, $endMonth, $company_id, $category_name[$i]);
			
			$this->FusionCharts->addDatasets(
				'Column3D Chart',
				array(
					$category_name[$i]=>array(
						'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
						'data'=>array(
							array('value'=>$thisMonthSum[$i]),
							array('value'=>$monthAvg[$i])
						)
					)
				)
			);
			
		}		
	}
	
	public function lastMonth()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/last_month';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$startYear = date('Y').'-01-01 00:00:00';
		$startMonth = strtotime(date('Y-m-').'01 00:00:00')-86400;
		$startMonth = date('Y-m',$startMonth).'-01 00:00:00';
		$endMonth = strtotime(date('Y-m-').'01 00:00:00')-86400;
		$endMonth = date('Y-m-t',$endMonth).' 23:59:59';
		$lastMonthTotal = '$'.number_format($this->Invoice->findSum('lastMonth',$company_id),2);
		$avgMonthTotal = '$'.number_format($this->Invoice->findSum('avgMonth',$company_id),2);
		$date_range = '('.date('n/d/y',strtotime($startMonth)).' - '.date('n/d/y',strtotime($endMonth)).')';
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('ff8400','d88aff','9fff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
		$dates = array('start'=>$startMonth,'end'=>$endMonth);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_nonth_year', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		$this->set('date',$dates);
		
		$this->FusionCharts->create(
			'Column3D Chart',
			array(
				'type' => 'StackedColumn3D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Column3D Chart',
			array(
				'caption'			=> 'Last Month Sales',
				'subCaption'		=> $date_range,
				'xAxisName'			=> 'Month Types',
				'yAxisName'			=> 'Sales (After Tax)',
				'decimalPrecision'	=> '2',
				'rotateNames'		=> '0',
				'numDivLines'		=> '3',
				'numberPrefix'		=> '$',
				'showValues'		=> '1',
				'formatNumberScale'	=> '0'
			)
		);
		
		$this->FusionCharts->addCategories(
			'Column3D Chart',
			array(
				date('F Y',strtotime($startMonth)).' ('.$lastMonthTotal.')',
				'Month Avg. ('.$avgMonthTotal.')'
			)
		);
		for ($i=0; $i < $category_count; $i++) { 
			$category_name[$i] = $category[$i]['Category']['name'];
			$thisMonthSum[$i] = $this->InvoiceLineitem->getCategory_values('thisMonth',$startMonth, $endMonth,$company_id, $category_name[$i]); 
			$monthAvg[$i] = $this->InvoiceLineitem->getCategory_values('monthAvg',$startYear, $endMonth, $company_id, $category_name[$i]);
			
			$this->FusionCharts->addDatasets(
				'Column3D Chart',
				array(
					$category_name[$i]=>array(
						'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
						'data'=>array(
							array('value'=>$thisMonthSum[$i]),
							array('value'=>$monthAvg[$i])
						)
					)
				)
			);
		}				
	}
	
	public function byMonth()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/by_month';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$startYear = date('Y').'-01-01 00:00:00';
		$this->set('months',
			array(
				'1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June',
				'7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'
			)
		);	
		$year = array();
		for ($i=2012; $i < date('Y')+1; $i++) { 
			$year[$i] = $i;
		}
		$this->set('year',$year);	
		//if month and year were selected
		if ($this->request->is('post')) {
			//set requested data
			$selectedYear = $this->request->data['byMonth']['Year'];
			$selectedMonth = $this->request->data['byMonth']['Month'];
			//set the new title for the page
			$this->set('title_for_layout',__('Month Sales Report - '.date('F',strtotime($selectedYear.'-'.$selectedMonth.'-01 00:00:00')).' '.$selectedYear));	
			//set variables		
			$this->set('setMonth', $selectedMonth);
			$startMonth = $selectedYear.'-'.$selectedMonth.'-01 00:00:00';
			$endMonth = date('Y-m-t',strtotime($startMonth)).' 23:59:59';
			$startYear = $selectedYear.'-01-01 00:00:00';
			$selectedMonthTotal = '$'.number_format($this->Invoice->findSum_choose('chooseMonth',$startMonth, $endMonth,$company_id),2);
			$avgMonthTotal = '$'.number_format($this->Invoice->findSum_choose('avgSelectedMonth',$selectedYear, $endMonth,$company_id),2);
			$date_range = '('.date('n/d/y',strtotime($startMonth)).' - '.date('n/d/y',strtotime($endMonth)).')';
			$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
			$category_count = count($category);
			$colorArray = array('ff8400','d88aff','9fff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
			$dates = array('start'=>$startMonth,'end'=>$endMonth);
			$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
			$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
			$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
			$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
			$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
			$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_month_year', $company_id, $dates, null, $tax_rate);
			//send to view to create report
			$this->set('category',$category);
			$this->set('category_totals',$category_totals);
			$this->set('orders_report',$orders_report);
			$this->set('endOfDay', $endOfDayTotals);	
			$this->set('date',$dates);			
			$this->FusionCharts->create(
				'Column3D Chart',
				array(
					'type' => 'StackedColumn3D',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);
	
			$this->FusionCharts->setChartParams(
				'Column3D Chart',
				array(
					'caption'			=> 'Selected Month Sales',
					'subCaption'		=> $date_range,
					'xAxisName'			=> 'Month Types',
					'yAxisName'			=> 'Sales (After Tax)',
					'decimalPrecision'	=> '2',
					'rotateNames'		=> '0',
					'numDivLines'		=> '3',
					'numberPrefix'		=> '$',
					'showValues'		=> '1',
					'formatNumberScale'	=> '0'
				)
			);
			
			$this->FusionCharts->addCategories(
				'Column3D Chart',
				array(
					date('F',strtotime($startMonth)).' '.$selectedYear.' ('.$selectedMonthTotal.')',
					'Month Avg. ('.$avgMonthTotal.')'
				)
			);
			for ($i=0; $i < $category_count; $i++) { 
				$category_name[$i] = $category[$i]['Category']['name'];
				$thisMonthSum[$i] = $this->InvoiceLineitem->getCategory_values('selectedMonth',$startMonth, $endMonth,$company_id, $category_name[$i]); 
				$monthAvg[$i] = $this->InvoiceLineitem->getCategory_values('selectedMonthAvg',$selectedYear, $endMonth, $company_id, $category_name[$i]);
				
				$this->FusionCharts->addDatasets(
					'Column3D Chart',
					array(
						$category_name[$i]=>array(
							'params'=>array('color'=>$colorArray[$i],'showValues'=>'1'),
							'data'=>array(
								array('value'=>$thisMonthSum[$i]),
								array('value'=>$monthAvg[$i])
							)
						)
					)
				);
			}
		}
	}
	
	public function thisYear()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/this_year';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		
		//set variables
		$company_id = $this->Session->read('Company.company_id');
		$startYear = date('Y').'-01-01 00:00:00';
		$endYear = date('Y-m-d H:i:s');
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
		$maxAmount = $this->Invoice->query('SELECT max(`Invoice`.`after_tax`) AS maxAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id`='.$company_id.'
										 AND created BETWEEN "'.$startYear.'" AND "'.$endYear.'"');
		$maxAmount = ceil($maxAmount[0][0]['maxAfterTax']);
		$dayValues = $this->Invoice->findSum('yearByDays',$company_id);
		$dayValues_count = count($dayValues);
		$weekValues = $this->Invoice->findSum('yearByWeeks',$company_id);
		$weekValues_count = count($weekValues);
		$monthValues = $this->Invoice->findSum('yearByMonth',$company_id);
		$monthValues_count = count($monthValues);
		for ($i=0; $i < $category_count; $i++) {
			$category_name= $category[$i]['Category']['name']; 
			$monthTotalsByCategory[$i] = $this->InvoiceLineitem->salesData('yearByMonth',$category_name,$company_id); 
		}
		$dates = array('start'=>$startYear,'end'=>$endYear);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_month_year', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		$this->set('date',$dates);		
		

		//day chart

		$this->FusionCharts->create(
			'Line2D Chart',
			array(
				'type' => 'Line',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);
		if ($dayValues_count <10) {
			$this->FusionCharts->setChartParams(
				'Line2D Chart',
				array(
					'caption'					=> date('Y').' Summary - By Days',
					'subcaption'				=> 'Every business day this year up to today',
					'xAxisName'					=> 'Day',
					'yAxisMinValue'				=> '0',
					'yAxisName'					=> 'Sales',
					'decimalPrecision'			=> '2',
					'rotateNames'				=> '1',
					'formatNumberScale'			=> '0',
					'numberPrefix'				=> '$',
					'showNames'					=> '1',
					'showValues'				=> '1',
					'showAlternateHGridColor'	=> '1',
					'AlternateHGridColor'		=> 'ff5904',
					'divLineColor'				=> 'ff5904',
					'divLineAlpha'				=> '20',
					'alternateHGridAlpha'		=> '5'
				)
			);
		} else {
			$this->FusionCharts->setChartParams(
				'Line2D Chart',
				array(
					'caption'					=> date('Y').' Summary - By Days',
					'subcaption'				=> 'Every business day this year up to today',
					'xAxisName'					=> 'Day',
					'yAxisMinValue'				=> '0',
					'yAxisName'					=> 'Sales',
					'decimalPrecision'			=> '2',
					'rotateNames'				=> '1',
					'formatNumberScale'			=> '0',
					'numberPrefix'				=> '$',
					'showNames'					=> '1',
					'showValues'				=> '0',
					'showAlternateHGridColor'	=> '1',
					'AlternateHGridColor'		=> 'ff5904',
					'divLineColor'				=> 'ff5904',
					'divLineAlpha'				=> '20',
					'alternateHGridAlpha'		=> '5'
				)
			);
		}
		for ($i=1; $i < $dayValues_count+1; $i++) {
			$date = date('n/d/y',$dayValues[$i]['date']);
			$value = $dayValues[$i]['sum'];
			$this->FusionCharts->addChartData(
				'Line2D Chart',
				array(
					array(
						'value' => $value, 
						'params' => array(
							'name' => $date,
							'hoverText'=>$date,
							'color'=> 'ff0000',
							'anchorBorderColor'	=> 'ff0000',
							'anchorBgColor'		=> 'ff0000'
						)
					)

				)
			);				
		}	
		//week chart
		$this->FusionCharts->create(
			'Area2D Chart',
			array(
				'type' => 'Area2D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Area2D Chart',
			array(
				'caption'					=> date('Y').' Summary - By Weeks',
				'subcaption'				=> 'Every business week up to today',
				'xAxisName'					=> 'Weeks',
				'yAxisName'					=> 'Sales',
				'yAxisMaxValue'				=> $maxAmount,
				'yAxisMinValue'				=> '0',
				'rotateNames'				=> '1',
				'decimalPrecision'			=> '2',
				'showValues'				=> '1',
				'showAlternateHGridColor'	=> '1',
				'areaBorderColor'			=> '005455',
				'AlternateHGridColor'		=> '5e5e5e',
				'divLineColor'				=> 'e5e5e5',
				'divLineAlpha'				=> '60',
				'alternateHGridAlpha'		=> '5',
				'numberPrefix'				=> '$'
			)
		);	

		for ($i=1; $i < date('W')+1; $i++) {
			$date = date('n/d/y',$weekValues[$i]['date']).' - '.$endWeek = date('n/d/y',strtotime('next sunday 11:59:59pm',$weekValues[$i]['date']));
			$weekNumber = date('W',$weekValues[$i]['date']);
			$value = $weekValues[$i]['sum'];
			$this->FusionCharts->addChartData(
				'Area2D Chart',
				array(
					array('value' => $value, 'params' => array('name' =>'Week #'.$weekNumber,'color'=>'75fdff','hoverText'=>'['.$weekNumber.'], '.$date))
				)
			);				
		}
		
		//month chart	
		$this->FusionCharts->create
			(
				'Column3DLineDY Chart',
				array
				(
					'type' => 'MSColumn3DLineDY',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);

		$this->FusionCharts->setChartParams
			(
				'Column3DLineDY Chart',
				array
				(
					'caption'				=> date('Y').' Sales - By Months',
					'PYAxisName'			=> 'Revenue',
					'SYAxisName'			=> 'Quantity',
					'numberPrefix'			=> '$',
					'showvalues'			=> '0',
					'rotateNames'			=> '1',
					'numDivLines'			=> '4',
					'formatNumberScale'		=> '0',
					'decimalPrecision'		=> '2',
					'anchorSides'			=> '10',
					'anchorRadius'			=> '3',
					'anchorBorderColor'		=> '009900'
				)
			);

		$this->FusionCharts->addCategories
			(
				'Column3DLineDY Chart',
				array(
					'January '. date('Y'),
					'February '. date('Y'),
					'March '. date('Y'),
					'April '. date('Y'),
					'May '. date('Y'),
					'June '. date('Y'),
					'July '. date('Y'),
					'August '. date('Y'),
					'September '. date('Y'),
					'October '. date('Y'),
					'November '. date('Y'),
					'December '. date('Y')
				)
			);
		for ($i=0; $i < $category_count; $i++) {
			$category_name = $category[$i]['Category']['name']; 
			$monthTotals = $monthTotalsByCategory[$i];
			$this->FusionCharts->addDatasets(
				'Column3DLineDY Chart',
				array(
					$category_name => array(
						'params' => array('color' => $colorArray[$i], 'showValues' => '0'),
						'data' => $monthTotals
					)
				)
			);			
		}
		$this->FusionCharts->addDatasets(
			'Column3DLineDY Chart',
			array(
				'Total Quantity' => array(
					'params' => array('color' => 'ff0000', 'showValues' => '1', 'parentYAxis' => 'S'),
					'data' => $monthValues
				)
			)
		);				
	}
	
	public function lastYear()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/last_year';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		
		//set variables
		$year = (date('Y')-1);
		$company_id = $this->Session->read('Company.company_id');
		$startYear = $year.'-01-01 00:00:00';
		$endYear = $year.'-12-31 23:59:59';
		$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
		$category_count = count($category);
		$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
		$maxAmount = $this->Invoice->query('SELECT max(`Invoice`.`after_tax`) AS maxAfterTax FROM invoices AS Invoice
										 WHERE `Invoice`.`company_id`='.$company_id.'
										 AND created BETWEEN "'.$startYear.'" AND "'.$endYear.'"');
		$maxAmount = ceil($maxAmount[0][0]['maxAfterTax']);
		if ($maxAmount == '') {
			$maxAmount = '100';
		}
		$dayValues = $this->Invoice->findSum('lastYearByDays',$company_id);
		$dayValues_count = count($dayValues);
		$weekValues = $this->Invoice->findSum('lastYearByWeeks',$company_id);
		$weekValues_count = count($weekValues);
		$monthValues = $this->Invoice->findSum('lastYearByMonth',$company_id);
		$monthValues_count = count($monthValues);
		for ($i=0; $i < $category_count; $i++) {
			$category_name= $category[$i]['Category']['name']; 
			$monthTotalsByCategory[$i] = $this->InvoiceLineitem->salesData('lastYearByMonth',$category_name,$company_id); 
		}
		$dates = array('start'=>$startYear,'end'=>$endYear);
		$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
		$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
		$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
		$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
		$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
		$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_month_year', $company_id, $dates, null, $tax_rate);
		//send to view to create report
		$this->set('category',$category);
		$this->set('category_totals',$category_totals);
		$this->set('orders_report',$orders_report);
		$this->set('endOfDay', $endOfDayTotals);	
		$this->set('date',$dates);	
		//day chart

		$this->FusionCharts->create(
			'Line2D Chart',
			array(
				'type' => 'Line',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);
		if ($dayValues_count <10) {
			$this->FusionCharts->setChartParams(
				'Line2D Chart',
				array(
					'caption'					=> $year.' Summary - By Days',
					'subcaption'				=> 'Every business day this year up to today',
					'xAxisName'					=> 'Day',
					'yAxisMinValue'				=> '0',
					'yAxisName'					=> 'Sales',
					'decimalPrecision'			=> '2',
					'rotateNames'				=> '1',
					'formatNumberScale'			=> '0',
					'numberPrefix'				=> '$',
					'showNames'					=> '1',
					'showValues'				=> '1',
					'showAlternateHGridColor'	=> '1',
					'AlternateHGridColor'		=> 'ff5904',
					'divLineColor'				=> 'ff5904',
					'divLineAlpha'				=> '20',
					'alternateHGridAlpha'		=> '5'
				)
			);
		} else {
			$this->FusionCharts->setChartParams(
				'Line2D Chart',
				array(
					'caption'					=> $year.' Summary - By Days',
					'subcaption'				=> 'Every business day this year up to today',
					'xAxisName'					=> 'Day',
					'yAxisMinValue'				=> '0',
					'yAxisName'					=> 'Sales',
					'decimalPrecision'			=> '2',
					'rotateNames'				=> '1',
					'formatNumberScale'			=> '0',
					'numberPrefix'				=> '$',
					'showNames'					=> '1',
					'showValues'				=> '0',
					'showAlternateHGridColor'	=> '1',
					'AlternateHGridColor'		=> 'ff5904',
					'divLineColor'				=> 'ff5904',
					'divLineAlpha'				=> '20',
					'alternateHGridAlpha'		=> '5'
				)
			);
		}
		for ($i=1; $i < $dayValues_count+1; $i++) {
			$date = date('n/d/y',$dayValues[$i]['date']);
			$value = $dayValues[$i]['sum'];
			$this->FusionCharts->addChartData(
				'Line2D Chart',
				array(
					array(
						'value' => $value, 
						'params' => array(
							'name' => $date,
							'hoverText'=>$date,
							'color'=> 'ff0000',
							'anchorBorderColor'	=> 'ff0000',
							'anchorBgColor'		=> 'ff0000'
						)
					)

				)
			);				
		}	
		//week chart
		$this->FusionCharts->create(
			'Area2D Chart',
			array(
				'type' => 'Area2D',
				'width' => 1000,
				'height' => 600,
				'id' => ''
			)
		);

		$this->FusionCharts->setChartParams(
			'Area2D Chart',
			array(
				'caption'					=> $year.' Summary - By Weeks',
				'subcaption'				=> 'Every business week up to today',
				'xAxisName'					=> 'Weeks',
				'yAxisName'					=> 'Sales',
				'yAxisMaxValue'				=> $maxAmount,
				'yAxisMinValue'				=> '0',
				'rotateNames'				=> '1',
				'decimalPrecision'			=> '2',
				'showValues'				=> '1',
				'showAlternateHGridColor'	=> '1',
				'areaBorderColor'			=> '005455',
				'AlternateHGridColor'		=> '5e5e5e',
				'divLineColor'				=> 'e5e5e5',
				'divLineAlpha'				=> '60',
				'alternateHGridAlpha'		=> '5',
				'numberPrefix'				=> '$'
			)
		);	
		
		for ($i=1; $i < 53; $i++) {
			$date = date('n/d/y',$weekValues[$i]['date']).' - '.$endWeek = date('n/d/y',strtotime('next sunday 11:59:59pm',$weekValues[$i]['date']));
			$weekNumber = date('W',$weekValues[$i]['date']);
			$value = $weekValues[$i]['sum'];
			$this->FusionCharts->addChartData(
				'Area2D Chart',
				array(
					array('value' => $value, 'params' => array('name' =>'Week #'.$weekNumber,'color'=>'75fdff','hoverText'=>'['.$weekNumber.'], '.$date))
				)
			);				
		}
		
		//month chart	
		$this->FusionCharts->create
			(
				'Column3DLineDY Chart',
				array
				(
					'type' => 'MSColumn3DLineDY',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);

		$this->FusionCharts->setChartParams
			(
				'Column3DLineDY Chart',
				array
				(
					'caption'				=> $year.' Sales - By Months',
					'PYAxisName'			=> 'Revenue',
					'SYAxisName'			=> 'Quantity',
					'numberPrefix'			=> '$',
					'showvalues'			=> '0',
					'rotateNames'			=> '1',
					'numDivLines'			=> '4',
					'formatNumberScale'		=> '0',
					'decimalPrecision'		=> '2',
					'anchorSides'			=> '10',
					'anchorRadius'			=> '3',
					'anchorBorderColor'		=> '009900'
				)
			);

		$this->FusionCharts->addCategories(
				'Column3DLineDY Chart',
				array(
					'January '. $year,
					'February '. $year,
					'March '. $year,
					'April '. $year,
					'May '. $year,
					'June '. $year,
					'July '. $year,
					'August '. $year,
					'September '.$year,
					'October '.$year,
					'November '.$year,
					'December '.$year
				)
			);
		for ($i=0; $i < $category_count; $i++) {
			$category_name = $category[$i]['Category']['name']; 
			$monthTotals = $monthTotalsByCategory[$i];
			$this->FusionCharts->addDatasets(
				'Column3DLineDY Chart',
				array(
					$category_name => array(
						'params' => array('color' => $colorArray[$i], 'showValues' => '0'),
						'data' => $monthTotals
					)
				)
			);			
		}
		$this->FusionCharts->addDatasets(
			'Column3DLineDY Chart',
			array(
				'Total Quantity' => array(
					'params' => array('color' => 'ff0000', 'showValues' => '1', 'parentYAxis' => 'S'),
					'data' => $monthValues
				)
			)
		);	
		
	}
	
	public function byYear()
	{
		//set the admin navigation
		$admin_nav = $this->Menu_item->arrangeByTiers($this->Session->read('Admin.menu_id'));	
		$page_url = '/reports/byYear';
		$admin_check = $this->Menu_item->menuActiveHeaderCheck($page_url, $admin_nav);
		$this->set('admin_nav',$admin_nav);
		$this->set('admin_pages',$page_url);
		$this->set('admin_check',$admin_check);	
		//set variables
		$year = array();
		for ($i=2012; $i < date('Y')+1; $i++) { 
			$year[$i] = $i;
		}
		$this->set('year',$year);	
		//if month and year were selected
		if ($this->request->is('post')) {
			//set the title for the page
			$this->set('title_for_layout',__($this->request->data['byYear']['Year'].' Sales Report'));	
			//set variables
			$year = $this->request->data['byYear']['Year'];
			$this->set('setYear',$year);
			$company_id = $this->Session->read('Company.company_id');
			$startYear = $year.'-01-01 00:00:00';
			$endYear = $year.'-12-31 23:59:59';
			$category = $this->Category->find('all',array('conditions'=>array('Category.company_id'=>$company_id,'Category.status'=>1),'order'=>array('Category.category_list'=>'asc')));
			$category_count = count($category);
			$colorArray = array('a2abff','00ff89','edff89','f3a0ff','ffa4a0','ae84cf','ae8469','69ae9f','acacac','009d9f','9f9600');
			$maxAmount = $this->Invoice->query('SELECT max(`Invoice`.`after_tax`) AS maxAfterTax FROM invoices AS Invoice
											 WHERE `Invoice`.`company_id`='.$company_id.'
											 AND created BETWEEN "'.$startYear.'" AND "'.$endYear.'"');
			$maxAmount = ceil($maxAmount[0][0]['maxAfterTax']);
			if ($maxAmount == '') {
				$maxAmount = '100';
			}
			$dayValues = $this->Invoice->findSum_selection('selectYearByDays',$year,$company_id);
			$dayValues_count = count($dayValues);
			$weekValues = $this->Invoice->findSum_selection('selectYearByWeeks',$year,$company_id);
			$weekValues_count = count($weekValues);
			$monthValues = $this->Invoice->findSum_selection('selectYearByMonths',$year,$company_id);
			$monthValues_count = count($monthValues);
			for ($i=0; $i < $category_count; $i++) {
				$category_name= $category[$i]['Category']['name']; 
				$monthTotalsByCategory[$i] = $this->InvoiceLineitem->getCategory_values('selectYearByMonth', $year, $endYear, $company_id, $category_name);
			}
			$dates = array('start'=>$startYear,'end'=>$endYear);
			$tax_rate = $this->TaxInfo->find('all',array('conditions'=>array('TaxInfo.company_id'=>$company_id)));
			$tax_rate = $tax_rate[0]['TaxInfo']['rate'];
			$orders = $this->Order->find('all',array('conditions'=>array('Order.company_id'=>$company_id)));
			$orders_report = $this->InvoiceLineitem->ordersReport('month_year',$company_id, $dates, $category, $orders);
			$category_totals = $this->InvoiceLineitem->ordersReport('categoryTotals_month_year',$company_id, $dates, $category, $tax_rate);
			$endOfDayTotals = $this->InvoiceLineitem->ordersReport('summaryReport_month_year', $company_id, $dates, null, $tax_rate);
			//send to view to create report
			$this->set('category',$category);
			$this->set('category_totals',$category_totals);
			$this->set('orders_report',$orders_report);
			$this->set('endOfDay', $endOfDayTotals);	
			$this->set('date',$dates);	
			//day chart
	
			$this->FusionCharts->create(
				'Line2D Chart',
				array(
					'type' => 'Line',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);
			if ($dayValues_count <10) {
				$this->FusionCharts->setChartParams(
					'Line2D Chart',
					array(
						'caption'					=> $year.' Summary - By Days',
						'subcaption'				=> 'Every business day this year up to today',
						'xAxisName'					=> 'Day',
						'yAxisMinValue'				=> '0',
						'yAxisName'					=> 'Sales',
						'decimalPrecision'			=> '2',
						'rotateNames'				=> '1',
						'formatNumberScale'			=> '0',
						'numberPrefix'				=> '$',
						'showNames'					=> '1',
						'showValues'				=> '1',
						'showAlternateHGridColor'	=> '1',
						'AlternateHGridColor'		=> 'ff5904',
						'divLineColor'				=> 'ff5904',
						'divLineAlpha'				=> '20',
						'alternateHGridAlpha'		=> '5'
					)
				);
			} else {
				$this->FusionCharts->setChartParams(
					'Line2D Chart',
					array(
						'caption'					=> $year.' Summary - By Days',
						'subcaption'				=> 'Every business day this year up to today',
						'xAxisName'					=> 'Day',
						'yAxisMinValue'				=> '0',
						'yAxisName'					=> 'Sales',
						'decimalPrecision'			=> '2',
						'rotateNames'				=> '1',
						'formatNumberScale'			=> '0',
						'numberPrefix'				=> '$',
						'showNames'					=> '1',
						'showValues'				=> '0',
						'showAlternateHGridColor'	=> '1',
						'AlternateHGridColor'		=> 'ff5904',
						'divLineColor'				=> 'ff5904',
						'divLineAlpha'				=> '20',
						'alternateHGridAlpha'		=> '5'
					)
				);
			}
			for ($i=1; $i < $dayValues_count+1; $i++) {
				$date = date('n/d/y',$dayValues[$i]['date']);
				$value = $dayValues[$i]['sum'];
				$this->FusionCharts->addChartData(
					'Line2D Chart',
					array(
						array(
							'value' => $value, 
							'params' => array(
								'name' => $date,
								'hoverText'=>$date,
								'color'=> 'ff0000',
								'anchorBorderColor'	=> 'ff0000',
								'anchorBgColor'		=> 'ff0000'
							)
						)
	
					)
				);				
			}	
			//week chart
			$this->FusionCharts->create(
				'Area2D Chart',
				array(
					'type' => 'Area2D',
					'width' => 1000,
					'height' => 600,
					'id' => ''
				)
			);
	
			$this->FusionCharts->setChartParams(
				'Area2D Chart',
				array(
					'caption'					=> $year.' Summary - By Weeks',
					'subcaption'				=> 'Every business week up to today',
					'xAxisName'					=> 'Weeks',
					'yAxisName'					=> 'Sales',
					'yAxisMaxValue'				=> $maxAmount,
					'yAxisMinValue'				=> '0',
					'rotateNames'				=> '1',
					'decimalPrecision'			=> '2',
					'showValues'				=> '1',
					'showAlternateHGridColor'	=> '1',
					'areaBorderColor'			=> '005455',
					'AlternateHGridColor'		=> '5e5e5e',
					'divLineColor'				=> 'e5e5e5',
					'divLineAlpha'				=> '60',
					'alternateHGridAlpha'		=> '5',
					'numberPrefix'				=> '$'
				)
			);	
			
			for ($i=1; $i < 53; $i++) {
				$date = date('n/d/y',$weekValues[$i]['date']).' - '.$endWeek = date('n/d/y',strtotime('next sunday 11:59:59pm',$weekValues[$i]['date']));
				$weekNumber = date('W',$weekValues[$i]['date']);
				$value = $weekValues[$i]['sum'];
				$this->FusionCharts->addChartData(
					'Area2D Chart',
					array(
						array('value' => $value, 'params' => array('name' =>'Week #'.$weekNumber,'color'=>'75fdff','hoverText'=>'['.$weekNumber.'], '.$date))
					)
				);				
			}
	
			//month chart	
			$this->FusionCharts->create(
					'Column3DLineDY Chart',
					array(
						'type' => 'MSColumn3DLineDY',
						'width' => 1000,
						'height' => 600,
						'id' => ''
					)
				);
	
			$this->FusionCharts->setChartParams(
					'Column3DLineDY Chart',
					array(
						'caption'				=> $year.' Sales - By Months',
						'PYAxisName'			=> 'Revenue',
						'SYAxisName'			=> 'Quantity',
						'numberPrefix'			=> '$',
						'showvalues'			=> '0',
						'rotateNames'			=> '1',
						'numDivLines'			=> '4',
						'formatNumberScale'		=> '0',
						'decimalPrecision'		=> '2',
						'anchorSides'			=> '10',
						'anchorRadius'			=> '3',
						'anchorBorderColor'		=> '009900'
					)
				);
	
			$this->FusionCharts->addCategories(
					'Column3DLineDY Chart',
					array(
						'January '. $year,
						'February '. $year,
						'March '. $year,
						'April '. $year,
						'May '. $year,
						'June '. $year,
						'July '. $year,
						'August '. $year,
						'September '.$year,
						'October '.$year,
						'November '.$year,
						'December '.$year
					)
				);
			for ($i=0; $i < $category_count; $i++) {
				$category_name = $category[$i]['Category']['name']; 
				$monthTotals = $monthTotalsByCategory[$i];
				$this->FusionCharts->addDatasets(
					'Column3DLineDY Chart',
					array(
						$category_name => array(
							'params' => array('color' => $colorArray[$i], 'showValues' => '0'),
							'data' => $monthTotals
						)
					)
				);			
			}
			$this->FusionCharts->addDatasets(
				'Column3DLineDY Chart',
				array(
					'Total Quantity' => array(
						'params' => array('color' => 'ff0000', 'showValues' => '1', 'parentYAxis' => 'S'),
						'data' => $monthValues
					)
				)
			);	
		}		
	}
}

?>