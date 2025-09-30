<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <style>
    /* General Layout */
    body {
      background: linear-gradient(135deg, #ece7df, #d9d1c7);
      font-family: 'Inter', Arial, sans-serif;
      color: #3d332b;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 960px;
      margin: 40px auto;
      background: #fffdf9;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(80, 60, 40, 0.15);
      padding: 32px;
    }

    /* Headers */
    h1 {
      text-align: center;
      font-family: 'Playfair Display', serif;
      color: #4e3d2d;
      font-size: 2rem;
      margin-bottom: 24px;
    }
    h2 {
      margin: 28px 0 12px;
      color: #7a634d;
      font-weight: 600;
      font-size: 1.2rem;
    }

    /* Forms */
    form.create-form,
    form.search-form {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      justify-content: center;
      margin-bottom: 24px;
    }
    input, button {
      font-size: 1rem;
    }
    input {
      padding: 10px 14px;
      border: 1.5px solid #d6c4af;
      border-radius: 10px;
      background: #f8f4ef;
      color: #3d332b;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    input:focus {
      border-color: #7a634d;
      outline: none;
      box-shadow: 0 0 6px rgba(122,99,77,0.25);
    }
    button {
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(90deg, #7a8f77, #a7b59c);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, background 0.3s;
    }
    button:hover {
      transform: translateY(-2px);
      background: linear-gradient(90deg, #6a7d67, #8fa183);
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 12px;
      margin-bottom: 24px;
    }
    th, td {
      padding: 14px;
      text-align: center;
    }
    th {
      background: #d9cfc2;
      color: #3d332b;
      border-radius: 10px 10px 0 0;
      font-weight: 600;
    }
    tr {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(80, 60, 40, 0.08);
      transition: box-shadow 0.2s;
    }
    tr:hover {
      box-shadow: 0 4px 12px rgba(80, 60, 40, 0.12);
    }

    /* Buttons inside table */
    .action-btn {
      padding: 6px 14px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      margin: 0 2px;
      transition: background 0.2s;
    }
    .action-btn.edit {
      background: #c9b29b;
      color: #3d332b;
    }
    .action-btn.delete {
      background: #a97a5c;
      color: #fff;
    }
    .action-btn:hover {
      background: #7a634d;
      color: #fff;
    }

    /* Pagination */
    .pagination {
      display: flex;
      justify-content: center;
      gap: 6px;
      flex-wrap: wrap;
      margin-top: 12px;
    }
    .pagination a,
    .pagination span {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid #d6c4af;
      background: #f8f4ef;
      color: #7a634d;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s;
    }
    .pagination a:hover {
      background: #7a634d;
      color: #fff;
    }
    .pagination .current {
      background: #7a634d;
      color: #fff;
      font-weight: 600;
    }
    .pagination .disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    .page-info {
      text-align: center;
      margin-top: 6px;
      font-size: 0.95rem;
      color: #7a634d;
      font-style: italic;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(60, 45, 30, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .modal.active { display: flex; }
    .modal-content {
      background: #fffdf9;
      padding: 28px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(60, 45, 30, 0.25);
      width: 320px;
      max-width: 95%;
    }
    .modal-content h3 {
      margin-top: 0;
      margin-bottom: 16px;
      color: #4e3d2d;
    }
    .modal-content label {
      display: block;
      margin: 8px 0 4px;
      font-size: 0.95rem;
      color: #7a634d;
    }
    .modal-content input {
      width: 100%;
      margin-bottom: 14px;
    }
    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }
    .save-btn {
      background: #7a8f77;
      color: #fff;
    }
    .cancel-btn {
      background: #d9cfc2;
      color: #3d332b;
    }
    .save-btn:hover {
      background: #6a7d67;
    }
    .cancel-btn:hover {
      background: #c0b2a0;
    }

    @media (max-width: 700px) {
      .container { padding: 16px; }
      table, th, td { font-size: 0.9rem; }
      form.create-form, form.search-form { flex-direction: column; }
    }
  </style>
</head>
<body>
<div class="container">
  <h1>🌿 Student Management</h1>

  <!-- Create Form -->
  <form class="create-form" method="POST" action="/students">
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Add Student</button>
  </form>

  <!-- Search Form -->
  <form class="search-form" method="GET" action="">
    <input type="text" name="search" placeholder="Search students..." value="<?= isset($search) ? htmlspecialchars($search) : '' ?>">
    <button type="submit">Search</button>
  </form>

  <!-- Table -->
  <h2>All Students</h2>
  <table>
    <tr>
      <th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Actions</th>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
      <td><?= $student['id']; ?></td>
      <td><?= $student['last_name']; ?></td>
      <td><?= $student['first_name']; ?></td>
      <td><?= $student['email']; ?></td>
      <td>
        <button class="action-btn edit" type="button"
          onclick="openEditModal(<?= $student['id']; ?>, '<?= htmlspecialchars($student['last_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['first_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['email'], ENT_QUOTES) ?>')">Edit</button>
        <form method="POST" action="/students/delete/" style="display:inline-block;" onsubmit="return confirm('Delete this student?')">
          <input type="hidden" name="id" value="<?= $student['id']; ?>">
          <button class="action-btn delete" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <!-- Pagination -->
  <?php if (isset($totalPages) && $totalPages > 1): ?>
    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?page=1<?= isset($search) ? '&search=' . urlencode($search) : '' ?>">&laquo; First</a>
        <a href="?page=<?= $page - 1 ?><?= isset($search) ? '&search=' . urlencode($search) : '' ?>">&lsaquo; Prev</a>
      <?php else: ?>
        <span class="disabled">&laquo; First</span>
        <span class="disabled">&lsaquo; Prev</span>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
          <span class="current"><?= $i ?></span>
        <?php else: ?>
          <a href="?page=<?= $i ?><?= isset($search) ? '&search=' . urlencode($search) : '' ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?><?= isset($search) ? '&search=' . urlencode($search) : '' ?>">Next &rsaquo;</a>
        <a href="?page=<?= $totalPages ?><?= isset($search) ? '&search=' . urlencode($search) : '' ?>">Last &raquo;</a>
      <?php else: ?>
        <span class="disabled">Next &rsaquo;</span>
        <span class="disabled">Last &raquo;</span>
      <?php endif; ?>
    </div>
    <div class="page-info">Page <?= $page ?> of <?= $totalPages ?></div>
  <?php endif; ?>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
  <div class="modal-content">
    <h3>Edit Student</h3>
    <form id="editForm" method="POST" action="/students/update">
      <input type="hidden" name="id" id="edit_id">
      <label for="edit_last_name">Last Name</label>
      <input type="text" name="last_name" id="edit_last_name" required>
      <label for="edit_first_name">First Name</label>
      <input type="text" name="first_name" id="edit_first_name" required>
      <label for="edit_email">Email</label>
      <input type="email" name="email" id="edit_email" required>
      <div class="modal-actions">
        <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
        <button type="submit" class="save-btn">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditModal(id, lastName, firstName, email) {
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_last_name').value = lastName;
  document.getElementById('edit_first_name').value = firstName;
  document.getElementById('edit_email').value = email;
  document.getElementById('editModal').classList.add('active');
}
function closeEditModal() {
  document.getElementById('editModal').classList.remove('active');
}
window.onclick = function(event) {
  var modal = document.getElementById('editModal');
  if (event.target === modal) {
    closeEditModal();
  }
}
</script>
</body>
</html>
