<?php

/**
 * app/Model/Page.php
 */
class Page extends AppModel {
    public $name = 'Page';

    //Models
/**
 * Page url redirecting url fix. used to to tell the router to redirect to the url action in the pages Controller
 * 
 * @return variable
 */
    public function fixUrl($first, $second, $third, $fourth, $fifth)
    {
        if ($first != null && $second == null && $third == null && $fourth == null && $fifth ==null) {
            $url = '/'.$first;
        } else if($first != null && $second != null && $third == null && $fourth ==null && $fifth ==null){
        	$url = '/'.$first.'/'.$second;
        } else if($first != null && $second != null && $third != null && $fourth ==null && $fifth ==null){
        	$url = '/'.$first.'/'.$second.'/'.$third;
        } else if($first != null && $second != null && $third != null && $fourth !=null && $fifth ==null){
        	$url = '/'.$first.'/'.$second.'/'.$third.'/'.$fourth;
        } else {
        	$url = '/'.$first.'/'.$second.'/'.$third.'/'.$fourth.'/'.$fifth;
        }
		return $url;
    }

/**
 * after finding the pages alter the data to make user readable
 * @param pages array
 * @return array;
 */
	public function afterFindPage($results)
	{
	    foreach ($results as $key => $val) {
			if (isset($val['Page']['status'])){
				$results[$key]['Page']['status'] = $this->statusConvert($val['Page']['status']);
			}
	    }
	    return $results;		
	}
	public function statusConvert($status)
	{
		
		switch ($status) {
			case 1:
				$status = 'Draft';
				break;
			
			default:
				$status = 'Published';
				break;
		}
		return $status;
	}
/**
 * Publish page to the db change status from 1 to 2
 * 
 * @return void
 */
	public function publishPage($id)
	{
		$this->id = $id;
		$this->saveField('Page.status', 2);		
	}
	
}


?>