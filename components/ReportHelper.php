<?php 
namespace app\components;

use yii\base\Model;

Class ReportHelper extends Model
{
	private $xml;

	public function __construct(\SimpleXMLElement $xml)
	{
		$this->xml = $xml;
	}

	/**
	 *
	 * Возвращаем json для отрисовки диаграммы "Рекомендации по направлениям обучения"
	 *
	 */
	
	public function getFirstCircleParams()
	{
		$circle1 = [];
        foreach ($this->xml->TestingReports->TestingReport->ReportBlocks->ReportBlock[3]->Scales->Scale as $key => $value) {
        	$circle1[(string)$value['title']] = $value['value'];
            // $circle1[] = \yii\helpers\Json::encode(['axis' => (string)$value['title'], 'value' => (string)$value['value']]);
        }
        return $circle1;
	}

	public function getSecondCircleParams()
	{
		$circle1 = [];
		if(!empty($this->xml->TestingReports->TestingReport->ReportBlocks->ReportBlock[4])){
	        foreach ($this->xml->TestingReports->TestingReport->ReportBlocks->ReportBlock[4]->Scales->Scale as $key => $value) {
	            $circle1[(string)$value['title']] = $value['value'];
	        }
	    }
        return $circle1;
	}

	public function getCirclePointSize($arr)
	{
		$points = [];
		foreach($arr as $key => $row){
			$points[] = ($row>=6)? '10':'3';
		}
		return $points;
	}

	public function getCirclePointColor($arr)
	{
		$points = [];
		foreach($arr as $key => $row){
			$points[] = ($row>=6)? '#e80e24':'#aba5a6';
		}
		return $points;
	}

	public function getProfileResults()
	{
		$params = [];
        foreach ($this->xml->TestingReports->TestingReport->ReportBlocks->ReportBlock[2]->Scales->Group as $i => $group) {
        	foreach ($group->Scale as $j => $value) {
        		$params[(string)$group['groupTitle']][(string)$value['scaleTitleLeft']] = (string)$value['scaleValue'];
        	}
            
        }
        return $params;
	}

	public function getTexts()
	{
		$params = [];
        foreach ($this->xml->TestingReports->TestingReport->ReportBlocks->ReportBlock[5]->Texts->Text as $i => $text) {
        	$params[(string)$text['scaleTitle']] = $text;
        }

        return $params;
	}

	/* Метод проверяет, в какой из 4 колонок находится маркер. 1 тип диаграмм */
	
	public function columnNumber($value)
	{
		switch(true){
			case ($value < 3.5): 
				return 0; 
			break;
			case ((3.5 <= $value) &&  ($value< 5.5)): 
				return 1; 
			break;
			case ((5.5 <= $value) && ($value < 7.5)): 
				return 2; 
			break;
			case ($value > 7.5): 
				return 3; 
			break;
		}
	}

	public function percentWidth($value)
	{
		switch(true){
			case ($value < 3.5): 
				return ($value-1)/2.5*100; 
			break;
			case ((3.5 <= $value) &&  ($value< 5.5)): 
				return ($value-3.5)/2*100; 
			break;
			case ((5.5 <= $value) && ($value < 7.5)): 
				return ($value-5.5)/2*100; 
			break;
			case ($value > 7.5): 
				return ($value-7.5)/2.5*100; 
			break;
		}
	}

	public function columnColor($column)
	{
		if(in_array($column, [0,3])){
			return "#1909ae";
			// return "rgba(25, 9, 174, 0.77)";
		}
		// return "rgba(171, 171, 243, 0.77)";
		return "#bdbaf6";
	}

	public function getStringValue($value)
	{
		return (fmod($value,1.0) == 0)?(int)$value:$value;
	}

	public function renderCentralTds($value)
	{
		$text = "";
		$column = $this->columnNumber($value);
		for($i = 0; $i < 4; $i++){
			$text.="<td class='graph-1'>";
			$text.=($column == $i)?'<div class="end" tooltip="'.$this->getStringValue($value).'" style="width:'.$this->percentWidth($value).'%; margin:5px 0 5px; background-color: '.$this->columnColor($column).'!important; height:20px;"></div>':'';
			$text.="</td>";
		}
		return $text;
	}
}