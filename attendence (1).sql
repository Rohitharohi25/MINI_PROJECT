CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rollNo VARCHAR(50) NOT NULL,
    labSubject VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    semester INT NOT NULL,
    branch VARCHAR(50) NOT NULL,
    sysNo INT NOT NULL,
    startTime DATETIME NOT NULL,
    endTime DATETIME NOT NULL
);
