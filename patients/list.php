<?php include("../config/db.php"); ?>
<?php include("../includes/header.php"); ?>

<?php

$limit = 5;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;


$search = $_GET['search'] ?? '';


$allowedSort = ['patient_name', 'age'];
$sort = $_GET['sort'] ?? 'patient_name';

if (!in_array($sort, $allowedSort)) {
    $sort = 'patient_name';
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-white">
    <h5 class="mb-0">Patient Records</h5>
  </div>

  <div class="card-body">

    <form method="get" class="row g-2 mb-3">
      <div class="col-md-5">
        <input type="text" name="search" class="form-control"
               placeholder="Search by name or diagnosis"
               value="<?= $_GET['search'] ?? '' ?>">
      </div>

      <div class="col-md-3">
        <select name="sort" class="form-select">
  <option value="patient_name"
    <?= ($sort == 'patient_name') ? 'selected' : '' ?>>
    Sort by Name
  </option>

  <option value="age"
    <?= ($sort == 'age') ? 'selected' : '' ?>>
    Sort by Age
  </option>
</select>
      </div>

      <div class="col-md-2">
        <button class="btn btn-primary w-100">Search</button>
      </div>

      <div class="col-md-2">
        <a href="create.php" class="btn btn-success w-100">+ Add Patient</a>
      </div>
    </form>

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-primary">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Diagnosis</th>
        <th width="160">Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php


$sql = "SELECT * FROM patients
        WHERE patient_name LIKE '%$search%'
           OR diagnosis LIKE '%$search%'
        ORDER BY $sort
        LIMIT $start, $limit";

$result = mysqli_query($conn, $sql);

$count_sql = "SELECT COUNT(*) AS total FROM patients
              WHERE patient_name LIKE '%$search%'
                 OR diagnosis LIKE '%$search%'";

$count_result = mysqli_query($conn, $count_sql);
$total_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($total_row['total'] / $limit);
      

      while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?= $row['patient_name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['age'] ?></td>
        <td>
          <span class="badge bg-info"><?= $row['gender'] ?></span>
        </td>
        <td><?= $row['diagnosis'] ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete.php?id=<?= $row['id'] ?>"
             class="btn btn-sm btn-danger"
             onclick="return confirm('Delete this patient?')">
             Delete
          </a>
        </td>
      </tr>
      <?php } ?>


    </tbody>
  </table>
</div>
<nav>
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
      <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>&sort=<?= $sort ?>">
          <?= $i ?>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
  </div>
</div>

<?php include("../includes/footer.php"); ?>