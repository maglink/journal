<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class GradeController extends EntityController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'grades' => $this->getRepository('Grade')->findAll(),
        ));
    }

    public function unitsAction()
    {
        $grade_id = (int) $this->params()->fromRoute('id', 0);
        $grade = $this->getRepository('Grade')->find($grade_id);
        if(!$grade) return $this->notFoundAction();
        return new ViewModel(array(
            'grade' => $grade,
            'units' => $grade->units,
        ));
    }

    public function subjectsAction()
    {
        $grade_id = (int) $this->params()->fromRoute('id', 0);
        $grade = $this->getRepository('Grade')->find($grade_id);
        if(!$grade) return $this->notFoundAction();
        return new ViewModel(array(
            'grade' => $grade,
            'subjects' => $grade->subjects,
        ));
    }

}


