<?php
namespace Admin\Controller;

use Journal\Controller\TableController;
use Zend\View\Model\ViewModel;

use Journal\Model\Grade;
use Journal\Form\GradeForm;
use Journal\Model\Mark;
use Journal\Form\MarkForm;

class AdminController extends TableController
{
    public function indexAction()
    {
        return new ViewModel();
    }
  
    public function addgradeAction()
    {
        $form = new GradeForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $grade = new Grade();
            $form->setInputFilter($grade->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $grade->exchangeArray($form->getData());
                $this->getGradeTable()->saveGrade($grade);

                return $this->redirect()->toRoute('grade');
            }
        }
        return array('form' => $form);
    }
    
    public function addmarkAction()
    {
        $unit_id = (int) $this->params()->fromRoute('id1', 0);
        $lesson_id = (int) $this->params()->fromRoute('id2', 0);
        $markValue = (int) $this->getMarkTable()->getMarkValueByUnitAndLesson($unit_id, $lesson_id);
         
       
        $unit = $this->getUnitTable()->getUnit($unit_id);
        $lesson = $this->getLessonTable()->getLesson($lesson_id);
        $subject = $this->getSubjectTable()->getSubject($lesson->subject_id);
        
        
        $form = new MarkForm();
        $form->get('unit_id')->setAttribute('value', $unit_id);
        $form->get('lesson_id')->setAttribute('value', $lesson_id);
        $form->get('value')->setAttribute('value', $markValue);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $mark = new Mark();
            $form->setInputFilter($mark->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $mark->exchangeArray($form->getData());
                $this->getMarkTable()->saveMark($mark);

                return $this->redirect('grade');
            }
        }
        return array(
            'form' => $form, 
            'unit' => $unit,
            'lesson' => $lesson,
            'subject' => $subject,
        );
    }
}


