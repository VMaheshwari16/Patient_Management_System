<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../includes/header.php";
?>

<div class="row justify-content-center">
  <div class="col-md-8">

    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Add New Patient</h5>
      </div>

      <div class="card-body">

        <form method="post" class="row g-3">

          <div class="col-md-6">
            <label class="form-label">Patient Name</label>
            <input type="text" name="patient_name" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label">Diagnosis</label>
            <textarea name="diagnosis" class="form-control" rows="2"></textarea>
          </div>

          <div class="col-md-12 d-flex justify-content-between">
            <a href="list.php" class="btn btn-secondary">Back</a>
            <button type="submit" name="save" class="btn btn-success">
              Save Patient
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['patient_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $diagnosis = $_POST['diagnosis'];

    $sql = "INSERT INTO patients
            (patient_name, email, phone, age, gender, diagnosis)
            VALUES
            ('$name', '$email', '$phone', '$age', '$gender', '$diagnosis')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Patient added successfully');
                window.location='list.php';
              </script>";
    }
}
?>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
