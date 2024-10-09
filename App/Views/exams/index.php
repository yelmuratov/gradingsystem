<?php
use App\Models\student\Student;
use App\Models\Subject\Subject;
use App\Models\Exam\Exam;

// Fetch students, subjects, and exams from the database
$students = Student::getAll();
$subjects = Subject::getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Student, Subject, and Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                        <a class="nav-link" href="/students">Talaba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/subjects">Fanlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/exams">Imtihon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/results">Natija</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">
    <h1>Exam create</h1>
    <form action="/create_ex" method="POST">
        <div class="mb-3">
            <label for="studentSelect" class="form-label">Select Student</label>
            <select class="form-select" name="student_id" id="studentSelect" required>
                <option value="">Choose a student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="subjectSelect" class="form-label">Select Subject</label>
            <select class="form-select" name="subject_id" id="subjectSelect" required>
                <option value="">Choose a subject</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="scoreInput" class="form-label">Score (max 100)</label>
            <input type="number" class="form-control" name="score" id="scoreInput" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
