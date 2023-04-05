<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Home', 'url'=>Yii::app()->HomeUrl, 'active'=>'true'),
        array('label'=>Rights::t('core', 'Assignments'), 'url'=>array('assignment/view'), 'active'=>'true'),
        array('label'=>Rights::t('core', 'Permissions'), 'url'=>array('authItem/permissions'), 'active'=>'true'),
        array('label'=>Rights::t('core', 'Roles'), 'url'=>array('authItem/roles'), 'active'=>'true'),
        array('label'=>Rights::t('core', 'Tasks'), 'url'=>array('authItem/tasks'), 'active'=>'true'),
        array('label'=>Rights::t('core', 'Operations'), 'url'=>array('authItem/operations'), 'active'=>'true'),
    ),
)); ?>
