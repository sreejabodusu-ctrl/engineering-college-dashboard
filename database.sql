-- 1. Insert Faculty Data
INSERT INTO Faculty (faculty_name, department, designation, email, phone) VALUES
('Dr. Ramesh Babu', 'CSE', 'Professor & HOD', 'ramesh.babu@college.edu', '9848012345'),
('Mrs. S. Lakshmi', 'AIML', 'Assistant Professor', 'lakshmi.s@college.edu', '9848054321');

-- 2. Insert Courses Data
INSERT INTO Courses (course_code, course_name, credits, semester, department) VALUES
('CS301', 'Database Management Systems', 4, 5, 'CSE'),
('AI302', 'Introduction to Artificial Intelligence', 4, 5, 'AIML'),
('CS303', 'Web Technologies', 3, 5, 'CSE');

-- 3. Insert Attendance Data (student_id 1 is Rahul, 2 is Priya)
INSERT INTO Attendance (student_id, course_id, attendance_date, status) VALUES
(1, 1, '2026-06-22', 'Present'),
(1, 3, '2026-06-22', 'Present'),
(2, 2, '2026-06-22', 'Absent');

-- 4. Insert Marks Data
INSERT INTO Marks (student_id, course_id, internal_marks, external_marks, total_marks, grade) VALUES
(1, 1, 23, 65, 88, 'A+'),
(1, 3, 20, 55, 75, 'A'),
(2, 2, 24, 68, 92, 'O');

-- 5. Insert Announcements Data
INSERT INTO Announcements (title, description, announcement_date) VALUES
('Mid-Term Exams', 'The internal mid-term examinations will commence from July 6th, 2026.', '2026-06-22'),
('Hackathon 2026', 'Registration is now open for the annual Ace Edu Track Hackathon.', '2026-06-20');

-- 6. Insert Parent Data (Passwords are plain text for testing, hash them later in your app code!)
INSERT INTO Parents (student_id, parent_name, email, phone, password) VALUES
(1, 'K. Srinivasa Rao', 'srinivas.k@example.com', '9988776655', 'parentpass123'),
(2, 'M. Sharma', 'sharma.m@example.com', '9988776644', 'parentpass456');