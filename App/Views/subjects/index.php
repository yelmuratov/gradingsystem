<?php
    use App\Models\subject\Subject;
    $limit = 10; 
    $selectedPage = 1;

    if (isset($_GET['page'])) {
        $selectedPage = (int)$_GET['page'];
    }

    $totalStudents = Subject::count();
    $totalPages = ceil($totalStudents / $limit);

    // Fetch students for the current page using paginate
    $students = Subject::paginate($selectedPage, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
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
    <a class="btn btn-primary mt-4" href="/subject_create">Create</a>
    <h1>Subjects</h1>
    <?php
        if(isset($_SESSION['subject_create'])){
            echo "<div class='alert alert-success'>".$_SESSION['subject_create']."</div>";
            unset($_SESSION['subject_create']);
        }
    ?>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NAME</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student) : ?>
            <tr>
                <th scope="row"><?= $student['id'] ?></th>
                <td><?= $student['name'] ?></td>
                <td>
                    <a href="/edit_sub?id=<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/delete_sub?id=<?= $student['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <!-- Previous Button -->
        <li class="page-item <?= $selectedPage == 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $selectedPage - 1 ?>">Previous</a>
        </li>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
          <li class="page-item <?= $i == $selectedPage ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <!-- Next Button -->
        <li class="page-item <?= $selectedPage == $totalPages ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $selectedPage + 1 ?>">Next</a>
        </li>
      </ul>
    </nav>
    </div>
</body>
</html>
