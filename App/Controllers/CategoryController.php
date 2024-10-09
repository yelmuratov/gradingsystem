<?php
namespace App\Controllers;

use App\Models\Product\Product;
use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Exam\Exam;

session_start();

class CategoryController{
    public function index(){
        include realpath(__DIR__ . "/../Views/index.php");
    }

    public function students(){
        include realpath(__DIR__ . "/../Views/students/index.php");
    }

    public function subjects(){
        include realpath(__DIR__ . "/../Views/subjects/index.php");
    }

    public function exams(){
        include realpath(__DIR__ . "/../Views/exams/index.php");
    }

    public function results(){
        include realpath(__DIR__ . "/../Views/results/index.php");
    }

    public function student_create(){
        include realpath(__DIR__ . "/../Views/students/create.php");
    }

    public function subject_create(){
        include realpath(__DIR__ . "/../Views/subjects/create.php");
    }

    public function exam_create(){
        $student_id = $_POST['student_id'];
        $subject_id = $_POST['subject_id'];
        $score = $_POST['score']; 
        
        // check student is not taking exam second time
        $student = Student::find($student_id);
        $subject = Subject::find($subject_id);
        $studentCheck = Exam::where('student_id',$student_id);
        $subjectCheck = Exam::where('subject_id',$subject_id);

        if($studentCheck && $subjectCheck){
            ?>
            <script>
                alert('Student is already taking this exam');
            </script>
            <?php
            header('Location: /exams');
            exit();
        }else{
            $data = [
                'student_id' => $student_id,
                'subject_id' => $subject_id,
                'score' => $score,
            ];
    
            try{
                Exam::create($data);
                $_SESSION['exam_create'] = 'Exam created successfully';
                header('Location: /exams');
                exit();
            }catch(\Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function save_student(){
        try{
            Student::create([
                'name' => $_POST['name'],
            ]);
            $_SESSION['student_create'] = 'Student created successfully';
            header('Location: /students');
            exit();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function save_subject(){
        try{
            Subject::create([
                'name' => $_POST['name'],
            ]);
            $_SESSION['subject_create'] = 'Subject created successfully';
            header('Location: /subjects');
            exit();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function save_exam(){
        try{
            Exam::create([
                'title' => $_POST['title'],
                'date' => $_POST['date'],
            ]);
            $_SESSION['exam_create'] = 'Exam created successfully';
            header('Location: /exams');
            exit();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function delete_student(){
        Student::delete($_GET['id']);
        $_SESSION['student_delete'] = 'Student deleted successfully';
        header('Location: /students');
        exit();
    }

    public function delete_subject(){
        Subject::delete($_GET['id']);
        $_SESSION['subject_delete'] = 'Subject deleted successfully';
        header('Location: /subjects');
        exit();
    }

    public function edit_student(){
        include realpath(__DIR__ . "/../Views/students/edit.php");
    }
    
    public function update_student(){
        $id = $_GET['id'];
        Student::update($id,[
            'name' => $_POST['name'],
        ]);
        $_SESSION['student_update'] = 'Student updated successfully';
        header('Location: /students');
        exit();
    }

    public function edit_subject(){
        include realpath(__DIR__ . "/../Views/subjects/edit.php");
    }

    public function update_subject(){
        $id = $_GET['id'];
        Subject::update($id,[
            'name' => $_POST['name'],
        ]);
        $_SESSION['subject_update'] = 'Subject updated successfully';
        header('Location: /subjects');
        exit();
    }
}
?>
