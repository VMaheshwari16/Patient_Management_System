<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../includes/header.php";

$id = $_GET['id'] ?? 0;

$result = mysqli_query($conn, "SELECT * FROM patients WHERE id=$id");
$patient = mysqli_fetch_assoc($result);
?>

<div class="row justify-content-center">
  <div class="col-md-8">

    <div class="card shadow-sm">
      <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Edit Patient</h5>
      </div>

      <div class="card-body">

        <form method="post" class="row g-3">

          <div class="col-md-6">
            <label class="form-label">Patient Name</label>
            <input type="text" name="patient_name" class="form-control"
                   value="<?= $patient['patient_name'] ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control"
                   value="<?= $patient['email'] ?>" disabled>
          </div>

          <div class="col-md-4">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                   value="<?= $patient['phone'] ?>" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control"
                   value="<?= $patient['age'] ?>" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
              <option <?= ($patient['gender']=="Male")?"selected":"" ?>>Male</option>
              <option <?= ($patient['gender']=="Female")?"selected":"" ?>>Female</option>
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label">Diagnosis</label>
            <textarea name="diagnosis" class="form-control" rows="2"><?= $patient['diagnosis'] ?></textarea>
          </div>

          <div class="col-md-12 d-flex justify-content-between">
            <a href="list.php" class="btn btn-secondary">Back</a>
            <button type="submit" name="update" class="btn btn-warning">
              Update Patient
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>

<?php
if (isset($_POST['update'])) {
    $name = $_POST['patient_name'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $diagnosis = $_POST['diagnosis'];

    $sql = "UPDATE patients SET
            patient_name='$name',
            phone='$phone',
            age='$age',
            gender='$gender',
            diagnosis='$diagnosis'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Patient updated successfully');
                window.location='list.php';
              </script>";
    }
}
?>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>