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
            $circle1[] = \yii\helpers\Json::encode(['axis' => (string)$value['title'], 'value' => (string)$value['value']]);
        }
        return $circle1;
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
        	$params[(string)$text['scaleTitle']] = (string)$text->asXML();
        }

        return $params;
	}
}