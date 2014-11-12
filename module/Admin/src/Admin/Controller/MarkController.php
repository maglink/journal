<?php
namespace Admin\Controller;

use Journal\Controller\EntityController;
use Journal\Entity\Mark;
use Journal\Form\MarkForm;

class MarkController extends EntityController
{
    
    public function editAction()
    {

        $unit_id = (int) $this->params()->fromRoute('unit_id', 0);
        $lesson_id = (int) $this->params()->fromRoute('lesson_id', 0);
        
        $unit = $this->getRepository('Unit')->find($unit_id);
        $lesson = $this->getRepository('Lesson')->find($lesson_id);
        if(!$lesson or !$unit) return $this->notFoundAction();
        $mark = $this->getRepository('Mark')
                ->findOneBy(array('unit' => $unit, 'lesson' => $lesson));
        
        $markValue = "";
        if($mark)
            $markValue = $mark->value;
        
        $form = new MarkForm();
        $form->get('unit_id')->setAttribute('value', $unit_id);
        $form->get('lesson_id')->setAttribute('value', $lesson_id);
        $form->get('value')->setAttribute('value', $markValue);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $data = $form->getData();

                if(!$mark) :
                    $mark = new Mark();
                    $mark->unit = $unit;
                    $mark->lesson = $lesson;
                    $mark->value = $data['value'];
                    $this->getEntityManager()->persist($mark);
                elseif(gettype($data['value']) != 'integer'
                        or $data['value'] == 0):
                    $this->getEntityManager()->remove($mark);
                else:
                    $mark->value = $data['value'];
                    $this->getEntityManager()->persist($mark);
                endif;
                $this->getEntityManager()->flush();
                
                return $this->redirect()->toRoute('journal', 
                        array('grade_id'=>$lesson->grade->id, 
                            'subject_id'=>$lesson->subject->id, 
                            'date'=>$lesson->date->format("Y-m-d")));
            }
        }

        return array(
            'form' => $form, 
            'unit' => $unit,
            'lesson' => $lesson
        );
    }
}


