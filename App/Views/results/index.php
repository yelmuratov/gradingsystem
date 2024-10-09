<?php
    use App\Database\DB;

    try{
        $db = new Db();
        $conn = $db->connect();
        $query = 'SELECT s.name AS student_name, COUNT(e.id) AS exams_number, AVG(e.score) AS average_score FROM students s JOIN exams e ON s.id = e.student_id GROUP BY s.name;';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $students = $stmt->fetchAll();

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
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
    <div class="container">
    <h1>Results</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">NAME</th>
          <th scope="col">THE NUMBER OF EXAMS</th>
          <th scope="col">AVERAGE SCORE</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?= $student['student_name'] ?></td>
                <td><?= $student['exams_number'] ?></td>
                <td><?= $student['average_score'] ?></td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
</body>
</html>
