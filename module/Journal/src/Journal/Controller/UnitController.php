<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class UnitController extends EntityController
{
    public function indexAction()
    {
        $unit_id = (int) $this->params()->fromRoute('id', 0);
        
        $unit = $this->getRepository('Unit')->find($unit_id);
        if(!$unit) return $this->notFoundAction();
        $grade = $unit->grade;

        $month = strtotime('this month');
        
        $marks = $this->getRepository('Unit')
                ->getAllTotalAvgMarksByMonth($unit, $month);

        return new ViewModel(array(
            'unit' => $unit,
            'grade' => $unit->grade,
            'month' => $month,
            'marks' => $marks,
        ));
    }
}