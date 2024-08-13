<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dark-mode {
            background-color: #1a202c;
            color: white;
        }

        .light-mode {
            background-color: white;
            color: black;
        }
    </style>
</head>

<body class="light-mode">
    <div class="flex justify-between items-center bg-gray-800 p-4">
        <div class="text-white font-bold">Aksamedia Interview</div>
        <div class="relative inline-block text-left">
            <button id="userButton"
                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white ">
                <span id="usernameDisplay">admin</span>
                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div id="dropdownMenu"
                class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="none">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                        onclick="editProfile()">Edit Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                        onclick="logout()">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6">
        <!-- Students Section -->
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Student Management</h1>
            <button onclick="openStudentModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Add Student</button>
        </div>

        <div class="mb-4">
            <input id="searchStudentInput" type="text" placeholder="Search by NIM, Name, or University"
                class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                oninput="handleStudentSearch()">
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="w-full bg-gray-100 text-left text-gray-700">
                    <th class="py-2 px-4 border-b">NIM</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">University</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody"></tbody>
        </table>

        <div id="studentPagination" class="mt-4 flex justify-between items-center">
            <button id="prevStudentPage" class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="changeStudentPage(currentStudentPage - 1)" disabled>Previous</button>
            <span id="studentPageInfo" class="text-gray-700"></span>
            <button id="nextStudentPage" class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="changeStudentPage(currentStudentPage + 1)">Next</button>
        </div>

        <!-- Employees Section -->
        <div class="mt-6 mb-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Employee Management</h1>
            <button onclick="openEmployeeModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Add Employee</button>
        </div>

        <div class="mb-4">
            <input id="searchEmployeeInput" type="text" placeholder="Search by Name, Phone, or Position"
                class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                oninput="handleEmployeeSearch()">
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="w-full bg-gray-100 text-left text-gray-700">
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Position</th>
                    <th class="py-2 px-4 border-b">Division</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody"></tbody>
        </table>

        <div id="employeePagination" class="mt-4 flex justify-between items-center">
            <button id="prevEmployeePage" class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="changeEmployeePage(currentEmployeePage - 1)" disabled>Previous</button>
            <span id="employeePageInfo" class="text-gray-700"></span>
            <button id="nextEmployeePage" class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="changeEmployeePage(currentEmployeePage + 1)">Next</button>
        </div>
    </div>

    <!-- Student Modal -->
    <div id="studentModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 id="studentModalTitle" class="text-lg font-bold mb-4">Add Student</h2>
            <form id="studentForm">
                <input type="hidden" id="studentId">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="nim">NIM</label>
                    <input id="nim" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter student NIM">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">Name</label>
                    <input id="name" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter student name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="univ">University</label>
                    <input id="univ" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter student university">
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="closeStudentModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Employee Modal -->
    <div id="employeeModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 id="employeeModalTitle" class="text-lg font-bold mb-4">Add Employee</h2>
            <form id="employeeForm">
                <input type="hidden" id="employeeId">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="empName">Name</label>
                    <input id="empName" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter employee name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="empPhone">Phone</label>
                    <input id="empPhone" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter employee phone">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="empPosition">Position</label>
                    <input id="empPosition" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter employee position">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="empDivision">Division</label>
                    <input id="empDivision" type="text"
                        class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter employee division ID">
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="closeEmployeeModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStudentPage = 1;
        let currentEmployeePage = 1;

        document.addEventListener('DOMContentLoaded', function() {
            fetchStudents();
            fetchEmployees();

            document.getElementById('studentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('studentId').value;
                const nim = document.getElementById('nim').value;
                const name = document.getElementById('name').value;
                const univ = document.getElementById('univ').value;

                if (id) {
                    updateStudent(id, {
                        nim,
                        name,
                        univ
                    });
                } else {
                    createStudent({
                        nim,
                        name,
                        univ
                    });
                }
            });

            document.getElementById('employeeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('employeeId').value;
                const name = document.getElementById('empName').value;
                const phone = document.getElementById('empPhone').value;
                const position = document.getElementById('empPosition').value;
                const division = document.getElementById('empDivision').value;

                if (id) {
                    updateEmployee(id, {
                        name,
                        phone,
                        position,
                        division
                    });
                } else {
                    createEmployee({
                        name,
                        phone,
                        position,
                        division
                    });
                }
            });
        });

        function fetchStudents() {
            fetch(`/students?page=${currentStudentPage}`)
                .then(response => response.json())
                .then(data => {
                    renderStudentTable(data);
                    updateStudentPagination(data);
                });
        }

        function fetchEmployees() {
            fetch(`/employees?page=${currentEmployeePage}`)
                .then(response => response.json())
                .then(data => {
                    renderEmployeeTable(data);
                    updateEmployeePagination(data);
                });
        }

        function createStudent(student) {
            fetch('/students', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(student)
                })
                .then(response => response.json())
                .then(() => {
                    fetchStudents();
                    closeStudentModal();
                });
        }

        function updateStudent(id, student) {
            fetch(`/students/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(student)
                })
                .then(response => response.json())
                .then(() => {
                    fetchStudents();
                    closeStudentModal();
                });
        }

        function deleteStudent(id) {
            fetch(`/students/${id}`, {
                    method: 'DELETE'
                })
                .then(() => {
                    fetchStudents();
                });
        }

        function createEmployee(employee) {
            fetch('/employees', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(employee)
                })
                .then(response => response.json())
                .then(() => {
                    fetchEmployees();
                    closeEmployeeModal();
                });
        }

        function updateEmployee(id, employee) {
            fetch(`/employees/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(employee)
                })
                .then(response => response.json())
                .then(() => {
                    fetchEmployees();
                    closeEmployeeModal();
                });
        }

        function deleteEmployee(id) {
            fetch(`/employees/${id}`, {
                    method: 'DELETE'
                })
                .then(() => {
                    fetchEmployees();
                });
        }

        function renderStudentTable(data) {
            const tbody = document.getElementById('studentTableBody');
            tbody.innerHTML = '';

            data.students.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${student.nim}</td>
                    <td class="py-2 px-4 border-b">${student.name}</td>
                    <td class="py-2 px-4 border-b">${student.univ}</td>
                    <td class="py-2 px-4 border-b">
                        <button onclick="editStudent(${student.id})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button onclick="deleteStudent(${student.id})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function renderEmployeeTable(data) {
            const tbody = document.getElementById('employeeTableBody');
            tbody.innerHTML = '';

            data.employees.forEach(employee => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${employee.name}</td>
                    <td class="py-2 px-4 border-b">${employee.phone}</td>
                    <td class="py-2 px-4 border-b">${employee.position}</td>
                    <td class="py-2 px-4 border-b">${employee.division ? employee.division.name : 'N/A'}</td>
                    <td class="py-2 px-4 border-b">
                        <button onclick="editEmployee(${employee.id})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button onclick="deleteEmployee(${employee.id})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function openStudentModal() {
            document.getElementById('studentModal').classList.remove('hidden');
            document.getElementById('studentModalTitle').textContent = 'Add Student';
            document.getElementById('studentForm').reset();
            document.getElementById('studentId').value = '';
        }

        function closeStudentModal() {
            document.getElementById('studentModal').classList.add('hidden');
        }

        function openEmployeeModal() {
            document.getElementById('employeeModal').classList.remove('hidden');
            document.getElementById('employeeModalTitle').textContent = 'Add Employee';
            document.getElementById('employeeForm').reset();
            document.getElementById('employeeId').value = '';
        }

        function closeEmployeeModal() {
            document.getElementById('employeeModal').classList.add('hidden');
        }

        function editStudent(id) {
            fetch(`/students/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('studentModal').classList.remove('hidden');
                    document.getElementById('studentModalTitle').textContent = 'Edit Student';
                    document.getElementById('studentId').value = data.id;
                    document.getElementById('nim').value = data.nim;
                    document.getElementById('name').value = data.name;
                    document.getElementById('univ').value = data.univ;
                });
        }

        function editEmployee(id) {
            fetch(`/employees/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('employeeModal').classList.remove('hidden');
                    document.getElementById('employeeModalTitle').textContent = 'Edit Employee';
                    document.getElementById('employeeId').value = data.id;
                    document.getElementById('empName').value = data.name;
                    document.getElementById('empPhone').value = data.phone;
                    document.getElementById('empPosition').value = data.position;
                    document.getElementById('empDivision').value = data.divisions_id;
                });
        }

        function handleStudentSearch() {
            const query = document.getElementById('searchStudentInput').value.toLowerCase();
            fetch(`/students?page=${currentStudentPage}`)
                .then(response => response.json())
                .then(data => {
                    const filteredStudents = data.students.filter(student =>
                        student.nim.toLowerCase().includes(query) ||
                        student.name.toLowerCase().includes(query) ||
                        student.univ.toLowerCase().includes(query)
                    );
                    renderStudentTable({
                        students: filteredStudents
                    });
                });
        }

        function handleEmployeeSearch() {
            const query = document.getElementById('searchEmployeeInput').value.toLowerCase();
            fetch(`/employees?page=${currentEmployeePage}`)
                .then(response => response.json())
                .then(data => {
                    const filteredEmployees = data.employees.filter(employee =>
                        employee.name.toLowerCase().includes(query) ||
                        employee.phone.toLowerCase().includes(query) ||
                        employee.position.toLowerCase().includes(query)
                    );
                    renderEmployeeTable({
                        employees: filteredEmployees
                    });
                });
        }

        function changeStudentPage(page) {
            if (page < 1) return;
            currentStudentPage = page;
            fetchStudents();
        }

        function changeEmployeePage(page) {
            if (page < 1) return;
            currentEmployeePage = page;
            fetchEmployees();
        }

        function updateStudentPagination(data) {
            document.getElementById('studentPageInfo').textContent = `Page ${data.current_page} of ${data.last_page}`;
            document.getElementById('prevStudentPage').disabled = !data.prev_page_url;
            document.getElementById('nextStudentPage').disabled = !data.next_page_url;
        }

        function updateEmployeePagination(data) {
            document.getElementById('employeePageInfo').textContent = `Page ${data.current_page} of ${data.last_page}`;
            document.getElementById('prevEmployeePage').disabled = !data.prev_page_url;
            document.getElementById('nextEmployeePage').disabled = !data.next_page_url;
        }

        function editProfile() {

        }

        function logout() {

        }
    </script>
</body>

</html>
