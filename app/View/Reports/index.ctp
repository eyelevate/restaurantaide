<?php

//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);



?>

<?php
$todayDate = 'todays date';
//BODY CONTENT
echo $this->Html->div('mainMenuDiv',
	$this->Html->tag('ul',
		$this->Html->tag('li',
			$this->Html->link('Main Menu',array('controller'=>'members','action'=>'index'),array('class'=>'backButton'))
		),
		array('class'=>'helpUl')
	).
	$this->Html->div('reportDiv',
		$this->Html->tag('a','<span>Today</span>'.$today,array('class'=>'todayButton','href'=>array('reports/today'))).
		$this->Html->tag('a','<span>This Week</span>'.$thisWeek,array('class'=>'thisWeekButton','href'=>array('controller'=>'reports/thisWeek'))).
		$this->Html->tag('a','<span>This Month</span>'.$thisMonth,array('class'=>'thisMonthButton','href'=>array('controller'=>'reports/thisMonth'))).
		$this->Html->tag('a','<span>This Year</span>'.$thisYear,array('class'=>'thisYearButton','href'=>array('controller'=>'reports/thisYear'))).
		'<br style="clear:both;"/>'.
		$this->Html->tag('a','<span>Yesterday</span>'.$yesterday,array('class'=>'yesterdayButton','href'=>array('controller'=>'reports/yesterday'))).
		$this->Html->tag('a','<span>Last Week</span>'.$lastWeek,array('class'=>'lastWeekButton','href'=>array('controller'=>'reports/lastWeek'))).
		$this->Html->tag('a','<span>Last Month</span>'.$lastMonth,array('class'=>'lastMonthButton','href'=>array('controller'=>'reports/lastMonth'))).
		$this->Html->tag('a','<span>Last Year</span>'.$lastYear,array('class'=>'lastYearButton','href'=>array('controller'=>'reports/lastYear'))).
		'<br style="clear:both;"/>'.
		$this->Html->link('By Dates',array('controller'=>'reports','action'=>'byDates'), array('class'=>'byDatesButton')).
		$this->Html->link('By Week',array('controller'=>'reports','action'=>'byWeeks'), array('class'=>'byWeekButton')).
		$this->Html->link('By Month',array('controller'=>'reports','action'=>'byMonth'), array('class'=>'byMonthButton')).
		$this->Html->link('By Year',array('controller'=>'reports','action'=>'byYear'), array('class'=>'byYearButton')),
		false
	),
	false
);

?>