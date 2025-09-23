<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f3ede7 0%, #e7d9c7 100%);
            font-family: 'Inter', Arial, sans-serif;
            color: #4e3b2c;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff8f0;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(120, 90, 60, 0.10);
            padding: 32px 28px 24px 28px;
        }
        h1 {
            text-align: center;
            color: #7c5e3c;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 1px;
        }
        h2 {
            color: #a68a64;
            font-size: 1.2rem;
            margin-top: 32px;
            margin-bottom: 12px;
            font-weight: 500;
        }
        form.create-form {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        form.create-form input {
            padding: 10px 14px;
            border: 1.5px solid #e0c9a6;
            border-radius: 8px;
            font-size: 1rem;
            background: #f7f2ec;
            transition: border-color 0.2s;
            color: #4e3b2c;
        }
        form.create-form input:focus {
            border-color: #a68a64;
            outline: none;
        }
        form.create-form button {
            background: linear-gradient(90deg, #a68a64 0%, #c9b29b 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(120, 90, 60, 0.08);
            transition: background 0.2s;
        }
        form.create-form button:hover {
            background: linear-gradient(90deg, #c9b29b 0%, #a68a64 100%);
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            background: #f7f2ec;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(120, 90, 60, 0.07);
            margin-bottom: 18px;
        }
        th, td {
            padding: 14px 10px;
            text-align: center;
        }
        th {
            background: #e7d9c7;
            color: #7c5e3c;
            font-weight: 600;
            font-size: 1rem;
        }
        tr {
            background: #fff;
            border-radius: 10px;
            transition: box-shadow 0.2s;
        }
        tr:hover {
            box-shadow: 0 2px 8px rgba(120, 90, 60, 0.10);
        }
        .action-btn {
            background: #a68a64;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 0.98rem;
            font-weight: 500;
            cursor: pointer;
            margin: 0 2px;
            transition: background 0.2s;
        }
        .action-btn.edit {
            background: #c9b29b;
            color: #4e3b2c;
        }
        .action-btn:hover {
            background: #7c5e3c;
            color: #fff;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 18px;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            color: #a68a64;
            background: #f7f2ec;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .pagination a:hover {
            background: #a68a64;
            color: #fff;
        }
        .pagination span {
            background: #a68a64;
            color: #fff;
        }
        .page-info {
            text-align: center;
            color: #a68a64;
            margin-top: 6px;
            font-size: 0.98rem;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0; width: 100vw; height: 100vh;
            background: rgba(120, 90, 60, 0.18);
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: #fff8f0;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(120, 90, 60, 0.18);
            padding: 32px 28px 24px 28px;
            min-width: 320px;
            max-width: 95vw;
            position: relative;
        }
        .modal-content h3 {
            margin-top: 0;
            color: #7c5e3c;
            font-weight: 600;
            margin-bottom: 18px;
        }
        .modal-content label {
            display: block;
            margin-bottom: 6px;
            color: #a68a64;
            font-size: 0.98rem;
        }
        .modal-content input {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #e0c9a6;
            border-radius: 8px;
            font-size: 1rem;
            background: #f7f2ec;
            margin-bottom: 16px;
            color: #4e3b2c;
        }
        .modal-content input:focus {
            border-color: #a68a64;
            outline: none;
        }
        .modal-content .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .modal-content .modal-actions button {
            padding: 8px 18px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
        }
        .modal-content .modal-actions .save-btn {
            background: #a68a64;
            color: #fff;
        }
        .modal-content .modal-actions .cancel-btn {
            background: #e7d9c7;
            color: #7c5e3c;
        }
        .modal-content .modal-actions .save-btn:hover {
            background: #7c5e3c;
        }
        .modal-content .modal-actions .cancel-btn:hover {
            background: #c9b29b;
        }
        @media (max-width: 700px) {
            .container { padding: 12px 2vw; }
            table, th, td { font-size: 0.95rem; }
            form.create-form { flex-direction: column; gap: 8px; }
            .modal-content { padding: 18px 8px; }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Management</h1>
    <form class="create-form" method="POST" action="/students">
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Add Student</button>
    </form>
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
                <button class="action-btn edit" type="button" onclick="openEditModal(<?= $student['id']; ?>, '<?= htmlspecialchars($student['last_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['first_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['email'], ENT_QUOTES) ?>')">Edit</button>
                <form method="POST" action="/students/delete/" style="display:inline-block;" onsubmit="return confirm('Delete this student?')">
                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                    <button class="action-btn" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <!-- Pagination Controls -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $page): ?>
                <span><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
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

