<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/25/16
 * Time: 8:31 PM
 */
class StudentController
{
    public  function listAction()
    {
        require_once ROOT . '/Model/StudentDB.php';
        $studentObj = new StudentDB();
        $students = $studentObj->getStudents();
        require_once ROOT . '/View/StudentList.php';

    }

    public function creatAction($data)
    {

    }

    public function updateAction($id, $data)
    {

    }

    public function deleteAction($id)
    {

    }
}