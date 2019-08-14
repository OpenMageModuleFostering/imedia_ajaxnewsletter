<?php
class Imedia_Ajaxnewsletter_Model_Cookies
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'3600', 'label'=>'1 Hour'),
            array('value'=>'43200', 'label'=>'12 Hours'),
            array('value'=>'86400', 'label'=>'24 Hours'),
			array('value'=>'172800', 'label'=>'2 Days'),
			array('value'=>'604800', 'label'=>'1 Week'),
			array('value'=>'1209600', 'label'=>'2 Weeks'),            
			array('value'=>'2419200', 'label'=>'1 Month'),            
			array('value'=>'7257600', 'label'=>'3 Months'),            
			array('value'=>'14515200', 'label'=>'6 Months'),            
        );
    }

}

